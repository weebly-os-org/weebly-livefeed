define([
  "App",
  "jquery",
  "underscore",
  "backbone",
  "marionette",
  "collections/AppInstallationCollection",
  "views/AppInstallationView",
], function (App, $, _, Backbone, Marionette, AppInstallationCollection, AppInstallationView) {
  var AppInstallationCollectionView = Backbone.Marionette.CollectionView.extend({
    tagName: "ul",
    childView: AppInstallationView
  });

  return AppInstallationCollectionView;
});