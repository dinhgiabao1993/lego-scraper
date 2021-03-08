const page = require('webpage').create()
const system = require('system')

try {
    getProducts(getPageNumber())
} catch (e) {
    console.log(JSON.stringify({success: false, error: e.message}))
    phantom.exit()
}

function getProducts(pageNumber) {
    const url = getBaseUrl(getMarketPlace()) + '?page=' + pageNumber
    page.open(url, function(status) {
        try {
            if (status !== 'success') {
                throw new Error('Unable to access ' + url)
            } else {
                const pageProducts = page.evaluate(function() {
                    var products = []
                    var productBlocks = document.querySelectorAll('div[class*="ProductListingsstyles__Content"] ul[class*="ProductGridstyles__Grid"] li[class*="ProductGridstyles__Item"] div[class*="ProductLeafListingstyles__Wrapper"]')
                    for (var i = 0; i < productBlocks.length; i++) {
                        var block = productBlocks[i]
                        var productName = block.querySelector('h2[class*="ProductLeafSharedstyles__Title"]').textContent
                        var productListingUrl = document.location.origin + block.querySelector('a[class*="ProductImagestyles__ProductImageLink"]').getAttribute('href')
                        var urlElements = productListingUrl.split('-')
                        var itemNumber = urlElements[urlElements.length - 1]
                        var currency = block.querySelector('div[class*="ProductPricestyles__Wrapper"] span[data-test="product-price"]').textContent.toLowerCase().replace('price', '').trim().substr(0, 1)
                        var price = block.querySelector('div[class*="ProductPricestyles__Wrapper"] span[data-test="product-price"]').textContent.match(/(\d+(?:\.\d+)?)/)[0]
                        var salePriceElement = block.querySelector('div[class*="ProductPricestyles__Wrapper"] span[data-test="product-price-sale"]')
                        var salePrice = salePriceElement ? salePriceElement.textContent.match(/(\d+(?:\.\d+)?)/)[0] : null
                        var discountPercentageElement = block.querySelector('div[class*="SalePercentageTag__SaleWrapper"] div[data-test="sale-percentage"]')
                        var discountPercentage = discountPercentageElement ? discountPercentageElement.textContent.match(/(\d+(?:\.\d+)?)/)[0] : null
                        var discountAmount = salePrice ? (parseFloat(price) - parseFloat(salePrice)).toPrecision(2) : null
                        var outOfStockElement = block.querySelector('div[class*="ProductLeafListingstyles__ActionRow"] span[type="outOfStock"]')
                        var ctaElement = block.querySelector('div[class*="ProductLeafListingstyles__ActionRow"] a[data-test="product-leaf-cta-shop-now"]')
                        var stockStatus = 'available'
                        if (outOfStockElement) {
                            stockStatus = 'out_of_stock'
                        }
                        if (ctaElement) {
                            stockStatus = 'cta'
                        }
                        products.push({
                            name: productName,
                            external_id: itemNumber,
                            url: productListingUrl,
                            currency: currency,
                            price: price,
                            sale_price: salePrice,
                            discount_amount: discountAmount,
                            discount_percentage: discountPercentage,
                            stock_status: stockStatus
                        })
                    }
                    const listingElement = document.querySelector('div[class*="ProductListingsstyles__Content"] div[data-test="listing-summary"]')
                    const listingNumbers = listingElement ? listingElement.textContent.trim().match(/[0-9]+/g) : []
                    return { products: products, more: listingNumbers.length == 3 && listingNumbers[1] != listingNumbers[2] }
                })
                pageProducts.products.forEach(function(product) {
                    product.marketplace = getMarketPlace().toUpperCase()
                })
                console.log(JSON.stringify({success: true, products: pageProducts.products, has_more: pageProducts.more}))
                phantom.exit()
            }
        } catch (e) {
            console.log(JSON.stringify({success: false, error: e.message}))
            phantom.exit()
        }
    })
}

function getBaseUrl(marketPlace) {
    if (marketPlace.toLowerCase() == 'uk') {
        return 'https://www.lego.com/en-gb/categories/retiring-soon'
    } else {
        return 'https://www.lego.com/en-us/categories/retiring-soon'
    }
}

function getMarketPlace() {
    if (typeof system.args[1] === 'undefined' || ['us', 'uk'].indexOf(system.args[1].toLowerCase()) == -1) {
        throw new Error('Invalid or missing Marketplace')
    }
    return system.args[1].toLowerCase()
}

function getPageNumber() {
    return typeof system.args[2] !== 'undefined' ? parseInt(system.args[2]) : 1
}