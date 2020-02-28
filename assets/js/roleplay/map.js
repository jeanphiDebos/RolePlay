/*
* not need look autoProvideVariables in webpack.config.js
* const $ = require('jquery');
*/
require('bootstrap-sass');

$.ajaxSetup({
  contentType: "application/json; charset=utf-8"
});

$(document).ready(function () {
  function affichageCarte(idMap) {
    $.get(apiMap + '/' + idMap, 'json').done(function (map) {
      try {
        if (map) {
          $('.image-map').addClass('hide').removeClass('carteEnCour');
          $('.masqueCarte').addClass("cacherCaseCarte");
          $("#" + map.id).addClass('carteEnCour').removeClass('hide');

          if (map.typeAffichage == "mapper") elementACacher(map);
          else if (map.typeAffichage == "cacher") toutCacher();
          else if (map.typeAffichage == "visible") toutAfficher();
        }
      } catch (e) {
        console.error("error: ajax apiMap: " + e);
      }
    }).fail(function (data) {
      console.error("error: ajax apiMap: " + data);
    });
  }

  function elementACacher(map) {
    $.get(apiMappingMap.replace('0', map.id), 'json').done(function (mappingsMap) {
      if ($('.masqueCarte').attr('id') != map.verticalAxis + "" + map.horizontalAxis) {
        $('.masqueCarte').empty();
        $('.masqueCarte').attr('id', map.verticalAxis + "" + map.horizontalAxis);

        for (var i = 0; i < map.horizontalAxis; i++) {
          for (var y = 0; y < map.verticalAxis; y++) {
            if (i == map.horizontalAxis - 1 && y == map.verticalAxis - 1) {
              $('.masqueCarte').append("<div class=\"caseMasqueCarte cacherCaseCarte LastVertical LastHorizontal caseHorizontal" + i + " caseVertical" + y + "\"></div>");
            } else if (i == map.horizontalAxis - 1) {
              $('.masqueCarte').append("<div class=\"caseMasqueCarte cacherCaseCarte LastHorizontal caseHorizontal" + i + " caseVertical" + y + "\"></div>");
            } else if (y == map.verticalAxis - 1) {
              $('.masqueCarte').append("<div class=\"caseMasqueCarte cacherCaseCarte LastVertical caseHorizontal" + i + " caseVertical" + y + "\"></div>");
            } else {
              $('.masqueCarte').append("<div class=\"caseMasqueCarte cacherCaseCarte caseHorizontal" + i + " caseVertical" + y + "\"></div>");
            }
          }
        }

        $(".caseMasqueCarte").css("width", Math.round(100 / map.verticalAxis) + "%");
        $(".caseMasqueCarte").css("height", Math.round(100 / map.horizontalAxis) + "%");

        $(".caseMasqueCarte.LastVertical").css("width", (Math.round(100 / map.verticalAxis)) + (100 - (Math.round(100 / map.verticalAxis) * map.verticalAxis)) + "%");
        $(".caseMasqueCarte.LastHorizontal").css("height", (Math.round(100 / map.horizontalAxis)) + (100 - (Math.round(100 / map.horizontalAxis) * map.horizontalAxis)) + "%");
      }

      $.each(mappingsMap, function (index, mappingMap) {
        $(".caseHorizontal" + mappingMap.horizontalAxis + ".caseVertical" + mappingMap.verticalAxis).removeClass("cacherCaseCarte");
      });

      $('.masqueCarte').removeClass("cacherCaseCarte");
    }).fail(function (data) {
      console.error("error: ajax apiMap: " + data);
    });
  }

  function toutCacher() {
    $('.masqueCarte').empty().addClass("cacherCaseCarte").attr('id', "");
  }

  function toutAfficher() {
    $('.masqueCarte').empty().removeClass("cacherCaseCarte").attr('id', "");
  }

  $('#button-show-map').on('click', function () {
    var idMap = $('#selected-map').val();

    affichageCarte(idMap);
  });
});