define([
  "App",
  "jquery",
  "underscore",
  "backbone",
  "marionette",
  "text!templates/event.html"
], function (App, $, _, Backbone, Marionette, tmpl) {

  var EventView = Backbone.Marionette.ItemView.extend({
    className: "cd-timeline-block",

    template: _.template(tmpl),

    events: {

    },

    render: function() {
      var view = this;
      var event_data = this.model.get('event_data');
      var tmpl = this.template({ 
        event: view.model
      });

      this.$el.html(tmpl);
      return this;
    }

  });

  return EventView;
});