'use strict';

const authentication = require('feathers-authentication');

const FacebookStrategy = require('passport-facebook').Strategy;
const FacebookTokenStrategy = require('passport-facebook-token');
const GoogleStrategy = require('passport-google-oauth20').Strategy;
const GoogleTokenStrategy = require('passport-google-token').Strategy;
const InstagramStrategy = require('passport-instagram').Strategy;
const InstagramTokenStrategy = require('passport-instagram-token');
const LinkedinStrategy = require('passport-linkedin-oauth2').Strategy;
const LinkedinTokenStrategy = require('passport-linkedin-token-oauth2').Strategy;

module.exports = function() {
  const app = this;

  let config = app.get('auth');
  
  config.facebook.strategy = FacebookStrategy;
  config.facebook.tokenStrategy = FacebookTokenStrategy;
  config.google.strategy = GoogleStrategy;
  config.google.tokenStrategy = GoogleTokenStrategy;
  config.instagram.strategy = InstagramStrategy;
  config.instagram.tokenStrategy = InstagramTokenStrategy;
  config.linkedin.strategy = LinkedinStrategy;
  config.linkedin.tokenStrategy = LinkedinTokenStrategy;

  app.set('auth', config);
  app.configure(authentication(config));
};
