require.config({
  baseUrl: '/js/app',
  paths: {
    'text'                : '../libs/text',
    'jquery'              : '../libs/jquery.min',
    'jqueryui'            : '../libs/jquery-ui.min',
    'underscore'          : '../libs/underscore.min',
    'backbone'            : '../libs/backbone.min',
    'marionette'          : '../libs/backbone.marionette.min',
    'handlebars'          : '../libs/handlebars',
    'i18nprecompile'      : '../libs/i18nprecompile',
    'json2'               : '../libs/json2',
    'hbs'                 : '../libs/hbs'
  },
  shim: {
    'underscore': {
      exports: '_'
    },
    'backbone': {
      deps: ['underscore', 'jquery'],
      exports: 'Backbone'
    },
    'marionette': {
      deps: ['backbone'],
      exports: 'Marionette'
    },
    'jquery-ui:': ["jquery"],
    'handlebars': {
      exports: "Handlebars"
    }
  },
  hbs: {
    templateExtension: "html",
    compileOptions: {}
  }
});

require(["init/init"]);
