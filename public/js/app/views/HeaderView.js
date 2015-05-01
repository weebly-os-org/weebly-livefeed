define([
  "App",
  "jquery",
  "underscore",
  "backbone",
  "marionette",
  "views/SiteOptionsView",
  "text!templates/header.html"
], function (App, $, _, Backbone, Marionette, SiteOptionsView, tmpl) {
  var HeaderView = Backbone.Marionette.LayoutView.extend({

    template: _.template(tmpl),

    regions: {
      'optionsRegion': '.site-options',
    },

    onShow: function(){
      var view = this;
      this.optionsRegion.show(new SiteOptionsView({collection: view.collection}))
    },

    events: {
      'click .change-site': 'toggleOptionsView'
    },

    toggleOptionsView: function(){
      this.optionsRegion.$el.toggleClass('open');
    }

  });

  return HeaderView;
});