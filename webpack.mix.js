const mix = require('laravel-mix')

mix.disableSuccessNotifications()
  // .sass('resources/css/arnold.scss', '../../../public/vendor/arnold/css')
  .sass('resources/css/arnold.scss', 'public/css')

if (mix.inProduction()) {
  mix.version()
}
