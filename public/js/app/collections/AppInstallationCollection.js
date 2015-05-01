define([
  "jquery",
  "backbone",
  "models/AppInstallation"
], function ($, Backbone, AppInstallation) {

  var AppInstallationCollection = Backbone.Collection.extend({

    model: AppInstallation,

    url: '/app_installations'

  });

  return AppInstallationCollection;
});