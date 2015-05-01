define([
  "jquery",
  "backbone",
  "models/Event"
], function ($, Backbone, Event) {

  var EventCollection = Backbone.Collection.extend({
    model: Event,

    url: function() {
    	return "/app_installation/"+this.app_installation_id+"/events";
    },

    initialize: function(models, options) {
    	this.app_installation_id = options.app_installation_id;	
    }
  
  });

  return EventCollection;
});