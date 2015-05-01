define([
  "jquery",
  "backbone",
  "marionette",
  "collections/EventCollection",
  "views/TimeLineView",
  "text!templates/app.html"
], function ($, Backbone, Marionette, EventCollection, TimeLineView, tmpl) {
  var AppView = Backbone.Marionette.LayoutView.extend({
    tagName: 'div',

    id: 'app',

    template: _.template(tmpl),

    events: {
      'click #show-app-installations': 'showAppInstallations'
    },

    regions: {
      'timelineRegion': '#timeline',
      'appInstallationRegion': '#appInstallations'
    },

    showAppInstallations: function (e) {
      e.preventDefault();
      var view = new AppInstallationCollectionView({ collection: appInstallationCollection });
      this.appInstallationRegion.show(view);
    },

    onShow: function () {
      var view = this;

      var install_id = this.$el.parents('#application').data('application-id');
      var installation = view.collection.findWhere({app_installation_id: install_id}) || view.collection.first();

      var eventCollection = installation.getEvents();
      eventCollection.fetch().done(function(){
        var timelineView = new TimeLineView({collection: eventCollection});
        view.timelineRegion.show(timelineView);
      });

      setInterval(function(){
        eventCollection.fetch();
      }, 1500);
    }
  });

  return AppView;
});