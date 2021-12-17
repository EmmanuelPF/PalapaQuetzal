export default function ({ property = '', exclude = [], force = false, cicleMethod = 'beforeMount' } = {}, callback) {
  return {
     [cicleMethod] () {
      if (this.$route.params[property]) {

        const globalProperties = Object.assign({}, this.$route.params[property])
        if (exclude.length) {
          const properties = Object.assign({}, globalProperties)
          exclude.forEach(function (valor) {
            delete properties[valor]
          })
          if (force) {
            this.$data[property] = properties
          } else {
            Object.assign(this.$data[property], properties)
          }
        } else {
          if (force) {
            this.$data[property] = globalProperties
          } else {
            Object.assign(this.$data[property], globalProperties)
          }
        }
        if (callback) callback(this, globalProperties)
      }
    },
  }
}
