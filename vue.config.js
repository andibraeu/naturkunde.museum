module.exports = {
  chainWebpack: config => {
    config.performance
      .hints(false)
      .maxEntrypointSize(512000)
      .maxAssetSize(512000)
  }
}
