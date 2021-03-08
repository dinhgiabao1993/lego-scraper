<p>Hi, {{$receiverEmail}}</p>
<br/>
<p>The scraper just finished its job recently.</p>
<p>Here are the new products discovered from the process:</p>
<br/>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Marketplace</th>
            <th>Item Number</th>
            <th>Listing Url</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Sale Price</th>
            <th>Discount Amount</th>
            <th>Discount Percentage</th>
            <th>Stock Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($newProducts as $index => $product)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$product->getMarketplace()}}</td>
            <td>{{$product->getExternalId()}}</td>
            <td><a target="_blank" href="{{$product->getUrl()}}">{{$product->getUrl()}}</a></td>
            <td>{{$product->getName()}}</td>
            <td>{{$product->getPrice() . ' ' . $product->getCurrency()}}</td>
            <td>{{$product->getSalePrice() ? ($product->getSalePrice() . ' ' . $product->getCurrency()) : ''}}</td>
            <td>{{$product->getDiscountAmount() ? ($product->getDiscountAmount() . ' ' . $product->getCurrency()) : ''}}</td>
            <td>{{$product->getDiscountPercentage() ? ($product->getDiscountPercentage() . '%') : ''}}</td>
            <td>{{strtoupper(str_replace('_', ' ', $product->getStockStatus()))}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <td>{{count($newProducts)}}</td>
            <td colspan="8"></td>
        </tr>
    </tfoot>
</table>
<br/>
<p>Regards!</p>

<style>
table { 
    width: 750px; 
    border-collapse: collapse; 
    margin:50px auto;
}

/* Zebra striping */
tr:nth-of-type(odd) { 
    background: #eee; 
    }

th { 
    background: #3498db; 
    color: white; 
    font-weight: bold; 
    }

td, th { 
    padding: 10px; 
    border: 1px solid #ccc; 
    text-align: left; 
    font-size: 18px;
    }

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

    table { 
        width: 100%; 
    }

    /* Force table to not be like tables anymore */
    table, thead, tbody, th, td, tr { 
        display: block; 
    }

    /* Hide table headers (but not display: none;, for accessibility) */
    thead tr { 
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    tr { border: 1px solid #ccc; }

    td { 
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee; 
        position: relative;
        padding-left: 50%; 
    }

    td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
        /* Label the data */
        content: attr(data-column);

        color: #000;
        font-weight: bold;
    }

}
</style>