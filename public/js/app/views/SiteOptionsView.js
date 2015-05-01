define([
  "App",
  "jquery",
  "underscore",
  "backbone",
  "marionette",
  "views/AppInstallationCollectionView",
  "text!templates/site_options.html"
], function (App, $, _, Backbone, Marionette, AppInstallationCollectionView, tmpl) {

  var SiteOptionsView = Backbone.Marionette.LayoutView.extend({
  
    template: _.template(tmpl),

    regions: {
      'siteListRegion': '.user-sites',
    },

    onShow: function() {
      var view = this;

      view.siteListRegion.show(new AppInstallationCollectionView({collection: view.collection}));
    } 

  });

  return SiteOptionsView;
});