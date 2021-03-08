import Vue from 'vue'

export default {
    install(_Vue, options) {
        _Vue.$eventBus = new Vue
    }
}