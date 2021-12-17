import Vue from 'vue'

export default Vue.mixin({
    data: {
        isMounted: false
    },
    mounted() {
        this.isMounted = true
    }
})