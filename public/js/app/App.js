define([
  'jquery',
  'underscore',
  'backbone',
  'marionette',
  'handlebars'
], function ($, _ , Backbone, Marionette, Handlebars) {
  var App = new Backbone.Marionette.Application();

  App.addRegions({
    headerRegion  : '#header',
    mainRegion    : '#main',
    sidebarRegion : '#sidebar'
  });

  return App;
});