define([
  "jquery",
  "backbone"
], function ($, Backbone) {
  var User = Backbone.Model.extend({
    urlRoot: '/user',
    defaults: {
      user_id: 0,
      username: "",
      password_hash: "",
      password_salt: ""
    },
    initialize: function () {
      var self = this;
      this.appInstallations = new AppInstallationCollection(this.get('app_installations'));
      this.appInstallations.url = function () {
        return self.url() + '/app_installations';
      };
    }
  });
  return User;
});