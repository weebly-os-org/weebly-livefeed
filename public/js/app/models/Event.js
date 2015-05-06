define([
  "jquery",
  "backbone"
], function ($, Backbone) {

  var Event = Backbone.Model.extend({
	
	getTitle: function(){
		return this.mapping[this.get('event_type')]['title'];
	},

	getIconClass: function(){
		return this.mapping[this.get('event_type')]['iconClass'];
	},

	getData: function(){
		return JSON.parse(this.get('event_data'));
	},

	mapping: {
		'user.update': {
			'title': 'You user was updated.',
			'iconClass': 'fa-user'
		},
        'site.copy': {
			'title': 'Your site was copied',
			'iconClass': 'fa-copy'
		},
        'site.delete': {
			'title': 'Your site was deleted.',
			'iconClass': 'fa-trash'
		},
        'site.publish': {
			'title': 'Your site was published.',
			'iconClass': 'fa-sitemap'
		},
        'site.update': {
			'title': 'Your site was updated.',
			'iconClass': 'fa-edit'
		},
        'store.info.update': {
			'title': 'Your store information was updated.',
			'iconClass': 'fa-building'
		},
        'store.category.create': {
			'title': 'A new category was created.',
			'iconClass': 'fa-list-alt'
		},
        'store.category.delete': {
			'title': 'A category was deleted.',
			'iconClass': 'fa-trash'
		},
        'store.category.update': {
			'title': 'A category was updated',
			'iconClass': 'fa-edit'
		},
        'store.product.create': {
			'title': 'A product was created.',
			'iconClass': 'fa-list-alt'
		},
        'store.product.delete': {
			'title': 'A product was deleted.',
			'iconClass': 'fa-trash'
		},
        'store.product.update': {
			'title': 'A product was updated.',
			'iconClass': 'fa-edit'
		},
        'store.cart.create': {
			'title': 'A user has created a shopping cart.',
			'iconClass': 'fa-shopping-cart'
		},
        'store.cart.update': {
			'title': 'A user has updated their shopping cart.',
			'iconClass': 'fa-shopping-cart'
		},
        'store.order.create': {
			'title': 'A user has created an order.',
			'iconClass': 'fa-folder'
		},
        'store.order.update': {
			'title': 'A user has updated their order.',
			'iconClass': 'fa-folder'
		},
        'store.order.ship': {
			'title': 'An order has been shipped.',
			'iconClass': 'fa-truck'
		},
        'store.order.pay': {
			'title': 'An order has been purchased.',
			'iconClass': 'fa-money'
		},
        'store.order.refund': {
			'title': 'An order has been refunded.',
			'iconClass': 'fa-money'
		},
        'store.order.return': {
			'title': 'An order has been returned.',
			'iconClass': 'fa-truck'
		},
        'store.order.cancel': {
			'title': 'An order has been cancelled.',
			'iconClass': 'fa-times'
		},
		'store.coupon.create': {
			'title': 'A coupon was created.',
			'iconClass': 'fa-ticket'
		},
		'store.coupon.update': {
			'title': 'A coupon was updated',
			'iconClass': 'fa-ticket'
		},
		'store.coupon.delete': {
			'title': 'A coupon was deleted.',
			'iconClass': 'fa-ticket'
		},
		'store.coupon.use': {
			'title': 'A coupon was used!.',
			'iconClass': 'fa-ticket'
		}
	}

  });
  
  return Event;

});