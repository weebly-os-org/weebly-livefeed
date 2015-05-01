define([
  "jquery",
  "backbone",
  "collections/EventCollection"
], function ($, Backbone, EventCollection) {

  var AppInstallation = Backbone.Model.extend({

    getEvents: function(){
      var model = this;
      var events = new EventCollection([], {'app_installation_id': model.get('app_installation_id')});

      return events;
    }

  });

  return AppInstallation;
});