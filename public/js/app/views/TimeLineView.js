define([
  "App",
  "jquery",
  "underscore",
  "backbone",
  "marionette",
  "views/EventView",
  "text!templates/timeline.html",
  "text!templates/empty.html"
], function (App, $, _, Backbone, Marionette, EventView, tmpl, emptyTmpl) {

  var TimelineView = Backbone.Marionette.CollectionView.extend({

    tagName: "section",
    
    template: _.template(tmpl),
    
    className: 'cd-container has-content',
    
    id: 'cd-timeline',
    
    childView: EventView,

    onShow: function() {
      if (this.collection.length === 0) {
        this.$el.removeClass('has-content');
      }
    },
    
    emptyView: Backbone.Marionette.ItemView.extend({
      template: emptyTmpl,
      className: 'empty-timeline'
    })

  });

  return TimelineView;
});
