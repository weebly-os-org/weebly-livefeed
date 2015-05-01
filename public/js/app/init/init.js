require([
  "App",
  'collections/AppInstallationCollection',
  'views/AppView',
  'views/HeaderView'
], function (App, AppInstallationCollection, AppView, HeaderView) {

  App.on('start', function() {
    var installations = new AppInstallationCollection();

    installations.fetch().done(function(){
      var appView = new AppView({
        collection: installations
      });

      App.headerRegion.show(new HeaderView({
        collection: installations
      }));
      
      App.mainRegion.show(appView);
    });
  });

  App.start();
});