(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["product_list"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/app/product/List.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/app/product/List.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_1__);


function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      loading: false,
      total: 0,
      filter: {
        page: 1,
        marketplace: null
      },
      products: [],
      marketplaces: [{
        value: null,
        text: 'Marketplace'
      }, {
        value: 'US',
        text: 'US'
      }, {
        value: 'UK',
        text: 'UK'
      }],
      source: null
    };
  },
  mounted: function mounted() {
    this.getProducts();
  },
  methods: {
    getProducts: function getProducts() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var response, _this$products;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (_this.source) {
                  _this.source.cancel('Request canceled');
                }

                _this.source = axios.CancelToken.source();
                _context.prev = 2;
                _this.loading = true;
                _context.next = 6;
                return axios.get('/products', {
                  params: _this.filter,
                  cancelToken: _this.source.token
                });

              case 6:
                response = _context.sent;

                if (Object(lodash__WEBPACK_IMPORTED_MODULE_1__["get"])(response, 'data.success')) {
                  _this.loading = false;

                  _this.products.splice(0);

                  (_this$products = _this.products).push.apply(_this$products, _toConsumableArray(Object(lodash__WEBPACK_IMPORTED_MODULE_1__["get"])(response, 'data.data.data', [])));

                  _this.filter.page = Object(lodash__WEBPACK_IMPORTED_MODULE_1__["get"])(response, 'data.data.current_page', 1);
                  _this.total = Object(lodash__WEBPACK_IMPORTED_MODULE_1__["get"])(response, 'data.data.total', 0);
                }

                _context.next = 13;
                break;

              case 10:
                _context.prev = 10;
                _context.t0 = _context["catch"](2);

                if (!axios.isCancel(_context.t0)) {
                  _this.loading = false;
                }

              case 13:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, null, [[2, 10]]);
      }))();
    },
    get: function get(key) {
      var defaultValue = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      return Object(lodash__WEBPACK_IMPORTED_MODULE_1__["get"])(key, defaultValue);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/app/product/List.vue?vue&type=template&id=30d15952&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/app/product/List.vue?vue&type=template&id=30d15952& ***!
  \*******************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "container-fluid" },
    [
      _c("h3", [_vm._v("Lego Retiring Soon Products")]),
      _vm._v(" "),
      _c(
        "b-form",
        { staticClass: "row" },
        [
          _c(
            "b-form-group",
            { staticClass: "col-md-2", attrs: { label: "Item Number" } },
            [
              _c("b-form-input", {
                attrs: {
                  type: "number",
                  min: "0",
                  step: "1",
                  placeholder: "Item Number"
                },
                on: {
                  keyup: function($event) {
                    if (
                      !$event.type.indexOf("key") &&
                      _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                    ) {
                      return null
                    }
                    return _vm.getProducts($event)
                  }
                },
                model: {
                  value: _vm.filter.external_id,
                  callback: function($$v) {
                    _vm.$set(_vm.filter, "external_id", $$v)
                  },
                  expression: "filter.external_id"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-form-group",
            { staticClass: "col-md-2", attrs: { label: "Marketplace" } },
            [
              _c("b-form-select", {
                attrs: { options: _vm.marketplaces },
                on: { change: _vm.getProducts },
                model: {
                  value: _vm.filter.marketplace,
                  callback: function($$v) {
                    _vm.$set(_vm.filter, "marketplace", $$v)
                  },
                  expression: "filter.marketplace"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-form-group",
            { staticClass: "col-md-2", attrs: { label: "Product Name" } },
            [
              _c("b-form-input", {
                attrs: {
                  type: "text",
                  min: "0",
                  step: "1",
                  placeholder: "Product Name"
                },
                on: {
                  keyup: function($event) {
                    if (
                      !$event.type.indexOf("key") &&
                      _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                    ) {
                      return null
                    }
                    return _vm.getProducts($event)
                  }
                },
                model: {
                  value: _vm.filter.name,
                  callback: function($$v) {
                    _vm.$set(_vm.filter, "name", $$v)
                  },
                  expression: "filter.name"
                }
              })
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("b-overlay", { attrs: { show: _vm.loading, rounded: "sm" } }, [
        _c("table", { staticClass: "table table-striped" }, [
          _c("thead", [
            _c("tr", [
              _c("th", { attrs: { scope: "col" } }, [_vm._v("#")]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [_vm._v("Marketplace")]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [_vm._v("Item Number")]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [_vm._v("Product Name")]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [_vm._v("Listing URL")]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [_vm._v("Price")]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [_vm._v("Sale Price")]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [
                _vm._v("Discount Amount")
              ]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [
                _vm._v("Discount Percentage")
              ]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [_vm._v("Spotted At")]),
              _vm._v(" "),
              _c("th", { attrs: { scope: "col" } }, [_vm._v("Stock Status")])
            ])
          ]),
          _vm._v(" "),
          _c(
            "tbody",
            [
              _vm._l(_vm.products, function(product, index) {
                return _c("tr", { key: product.id }, [
                  _c("th", { attrs: { scope: "row" } }, [
                    _vm._v(_vm._s(index + 1))
                  ]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(_vm.get(product, "marketplace")))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(_vm.get(product, "external_id")))]),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(_vm.get(product, "name")))]),
                  _vm._v(" "),
                  _c("td", [
                    _vm.get(product, "url")
                      ? _c("a", { attrs: { href: _vm.get(product, "url") } }, [
                          _vm._v(_vm._s(_vm.get(product, "url")))
                        ])
                      : _vm._e()
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _vm._v(
                      _vm._s(_vm.get(product, "price")) +
                        " " +
                        _vm._s(_vm.get(product, "currency"))
                    )
                  ]),
                  _vm._v(" "),
                  _c(
                    "td",
                    [
                      _vm.get(product, "sale_price")
                        ? [
                            _vm._v(
                              _vm._s(_vm.get(product, "sale_price")) +
                                " " +
                                _vm._s(_vm.get(product, "currency"))
                            )
                          ]
                        : _vm._e()
                    ],
                    2
                  ),
                  _vm._v(" "),
                  _c(
                    "td",
                    [
                      _vm.get(product, "discount_amount")
                        ? [
                            _vm._v(
                              _vm._s(_vm.get(product, "discount_amount")) +
                                " " +
                                _vm._s(_vm.get(product, "currency"))
                            )
                          ]
                        : _vm._e()
                    ],
                    2
                  ),
                  _vm._v(" "),
                  _c(
                    "td",
                    [
                      _vm.get(product, "discount_percentage")
                        ? [
                            _vm._v(
                              _vm._s(_vm.get(product, "discount_percentage")) +
                                "%"
                            )
                          ]
                        : _vm._e()
                    ],
                    2
                  ),
                  _vm._v(" "),
                  _c("td", [_vm._v(_vm._s(_vm.get(product, "spotted_at")))]),
                  _vm._v(" "),
                  _c("td", [
                    _vm._v(
                      _vm._s(_vm.get(product, "stock_status", "").toUpperCase())
                    )
                  ])
                ])
              }),
              _vm._v(" "),
              !_vm.products.length
                ? _c("tr", [
                    _c(
                      "td",
                      { staticClass: "text-center", attrs: { colspan: "11" } },
                      [_vm._v("No Products Found")]
                    )
                  ])
                : _vm._e()
            ],
            2
          )
        ])
      ]),
      _vm._v(" "),
      _c("b-pagination", {
        attrs: { align: "center", "total-rows": _vm.total, "per-page": "15" },
        on: { input: _vm.getProducts },
        model: {
          value: _vm.filter.page,
          callback: function($$v) {
            _vm.$set(_vm.filter, "page", $$v)
          },
          expression: "filter.page"
        }
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/app/product/List.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/app/product/List.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _List_vue_vue_type_template_id_30d15952___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./List.vue?vue&type=template&id=30d15952& */ "./resources/js/components/app/product/List.vue?vue&type=template&id=30d15952&");
/* harmony import */ var _List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./List.vue?vue&type=script&lang=js& */ "./resources/js/components/app/product/List.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _List_vue_vue_type_template_id_30d15952___WEBPACK_IMPORTED_MODULE_0__["render"],
  _List_vue_vue_type_template_id_30d15952___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/app/product/List.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/app/product/List.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/app/product/List.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./List.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/app/product/List.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/app/product/List.vue?vue&type=template&id=30d15952&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/app/product/List.vue?vue&type=template&id=30d15952& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_30d15952___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./List.vue?vue&type=template&id=30d15952& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/app/product/List.vue?vue&type=template&id=30d15952&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_30d15952___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_30d15952___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);