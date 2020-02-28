/*
* not need look autoProvideVariables in webpack.config.js
* const $ = require('jquery');
*/
require('bootstrap-sass');

$.ajaxSetup({
  contentType: "application/json; charset=utf-8"
});

$(document).ready(function () {
  $('#button-search-bestiary').on('click', function () {
    var searchBestiary = $('#value-search-bestiary').val();

    $('.bestiarie .name-bestiary').each(function(index) {
      console.log(searchBestiary);
      console.log($(this).text());
      if ($(this).text().indexOf(searchBestiary) === -1) {
        console.log('test');
        $(this).addClass('test');
        $(this).parent().parent().addClass('hide');
      } else {
        console.log('test2');
        $(this).parent().parent().removeClass('hide');
      }
    });
  });

  $('#button-clear-bestiary').on('click', function () {
    $('.bestiarie').each(function(index) {
      $(this).removeClass('hide');
    });
  });
});
