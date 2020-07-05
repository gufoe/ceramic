module.exports = {
  configureWebpack: {
    resolve: {

    }
  },
  // devServer Options don't belong into `configureWebpack`
  devServer: {
    host: '0.0.0.0',
    port: 8080,
    hot: true,
    disableHostCheck: true,
  },
  chainWebpack: config => {
    config
      .plugin('html')
      .tap(args => {
        args[0].title = 'Ceramic'
        return args
      })
  },
};
