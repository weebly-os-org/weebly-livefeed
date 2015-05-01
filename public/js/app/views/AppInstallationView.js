define([
  "App",
  "jquery",
  "underscore",
  "backbone",
  "marionette",
  "models/AppInstallation",
  "text!templates/appinstallationitem.html"
], function (App, $, _, Backbone, Marionette, AppInstallation, tmpl) {
  var AppInstallationView = Backbone.Marionette.ItemView.extend({
    tagName: "div",
    className: "app-installation",
    template: _.template(tmpl),
    model: AppInstallation,
    events: {

    },
    render: function() {
      var tmpl = this.template({ app_installation: this.model.toJSON() });
      this.$el.html(tmpl);
      return this;
    }
  });
  return AppInstallationView;
});