/*
 * not need look autoProvideVariables in webpack.config.js
 * const $ = require('jquery');
 */
require('bootstrap-sass');
require('bootstrap-select');

// import 'bootstrap';
// import selectpicker from 'bootstrap-select';

$.ajaxSetup({
  contentType: 'application/json; charset=utf-8'
});

$(document).ready(function () {
  var listPlayers =[];
  var listBestiaries =[];

  var $listingSelectedEncounter = $('#listing-selected-encounter');
  var $pathfinderRound = $('#pathfinder-round');
  var $pathfinderTotalXP = $('#pathfinder-total-xp');
  var $pathfinderTypeEncounter = $('#pathfinder-type-encounter');

  var $protoEncounter = $('#proto-selected-encounter-item');
  var $protoEncounterPlayer = $('#proto-selected-encounter-item-player');
  var $protoEncounterBestiary = $('#proto-selected-encounter-item-bestiary');

  var $listEncounterPlayer = $('#list-selected-encounter-item-player');
  var $listEncounterBestiary = $('#list-selected-encounter-item-bestiary');

  var $selectPlayer = $('#select-encounter-item-player');
  var $selectBestiary = $('#select-encounter-item-bestiary');
  
  var $modalSheetBestiary = $('#modal-sheet-bestiary');
  var $modalSheetBestiaryTitre = $('#sheet-bestiary-info-titre');
  var $modalSheetBestiaryTags = $('#sheet-bestiary-info-tags');
  var $modalSheetBestiaryImage = $('#sheet-bestiary-info-image');

  function initDataTracker()
  {
    $.get(apiPathfinderPlayers, 'json').done(function (players) {
      try {
        listPlayers = players;
      } catch (e) {
        console.error('error: ajax apiPathfinderPlayers: ' + e);
      }
    }).fail(function (data) {
      console.error('error: ajax apiPathfinderPlayers: ' + data);
    });

    $.get(apiPathfinderBestiaries, 'json').done(function (bestiarie) {
      try {
        listBestiaries = bestiarie;
      } catch (e) {
        console.error('error: ajax apiPathfinderBestiaries: ' + e);
      }
    }).fail(function (data) {
      console.error('error: ajax apiPathfinderBestiaries: ' + data);
    });

  }

  function findPlayer(idPlayer)
  {
    let playerFind = listPlayers.filter(function (player) {
      return player.id === idPlayer
    });
    
    if (playerFind.length !== 0) {
      return playerFind[0];
    }

    return null;
  }

  function findBestiary(idBestiary)
  {
    let bestiaryFind = listBestiaries.filter(function (bestiary) {
      return bestiary.id === idBestiary
    });
    
    if (bestiaryFind.length !== 0) {
      return bestiaryFind[0];
    }

    return null;
  }

  function showModalSheetBestiary(idBestiary)
  {
    let bestiary = findBestiary(idBestiary);

    if (bestiary == null) {
      return;
    }

    $modalSheetBestiaryTags.empty();
    $modalSheetBestiaryTitre.empty().append(bestiary.name);
    $modalSheetBestiaryImage.attr('src', bestiary.sheet);

    bestiary.typeBestiarys.forEach(function(typeBestiary){
        let style = 'color: ' + typeBestiary.categoryBestiary.textColor + '; background-color: ' + typeBestiary.categoryBestiary.backgroundColor + ';';
        console.log(style);
        $modalSheetBestiaryTags.append('<span class="type-bestiary ' + typeBestiary.categoryBestiary.name + '" style="' + style + '">' + typeBestiary.name + '</span>');
    });

    $modalSheetBestiary.modal();
  }

  function calculeXPBestiary(lvlBestiary, lvlAveragePlayes)
  {
    lvlBestiary = Math.floor(lvlBestiary);
    lvlAveragePlayes = Math.floor(lvlAveragePlayes);

    deltalvl = lvlBestiary - lvlAveragePlayes;

    if (deltalvl <= -4) {
      return 10;
    } else if (deltalvl == -3) {
      return 15;
    } else if (deltalvl == -2) {
      return 20;
    } else if (deltalvl == -1) {
      return 30;
    } else if (deltalvl == 0) {
      return 40;
    } else if (deltalvl == 1) {
      return 60;
    } else if (deltalvl == 2) {
      return 80;
    } else if (deltalvl == 3) {
      return 120;
    } else if (deltalvl >= 4) {
      return 160;
    }
  }

  function calculeTypeEncounter(totalXP, encounterPlayers)
  {
    if (totalXP < 15*encounterPlayers) {
      return 'Triviale';
    } else if (totalXP < 20*encounterPlayers) {
      return 'Faible';
    } else if (totalXP < 30*encounterPlayers) {
      return 'Moderee';
    } else if (totalXP < 40*encounterPlayers) {
      return 'Serieuse';
    } else {
      return 'Extreme';
    }
  }

  $('#add-encounter-player').on('click', function () {
    let idPlayer = $selectPlayer.val();

    if (idPlayer == "") {
      return;
    }

    let player = findPlayer(idPlayer);

    try {
      if (player == null) {
        return;
      }

      $newEncounterPlayer = $protoEncounterPlayer.clone();
      $newEncounterPlayerRemove = $newEncounterPlayer.find('.selected-encounter-item-player-remove');

      $newEncounterPlayer.removeClass('hide');
      $newEncounterPlayer.removeAttr('id');
      $newEncounterPlayer.attr('data-id-item', player.id);
      $newEncounterPlayer.data('id-item', player.id);
      $newEncounterPlayer.find('.name').empty().append(player.name + ' (lvl&nbsp;:&nbsp;' + player.level + ')');
      $newEncounterPlayer.find('.level').val(player.level);
      $newEncounterPlayer.find('.initiation').val(player.initiation);
      $newEncounterPlayer.find('.pv').empty().append(player.lifePoint);
      $newEncounterPlayer.find('.selected-encounter-item-player-remove')
      $newEncounterPlayerRemove.data('id-item', player.id)
      $newEncounterPlayerRemove.attr('data-id-item', player.id);
      $listEncounterPlayer.append($newEncounterPlayer);

      $selectPlayer.find("option[value='"+idPlayer+"']").attr('disabled','disabled');
      $selectPlayer.val('');

      $newEncounterPlayerRemove.click(function () {
        id = $(this).attr('data-id-item');
        $(this).closest('.selected-encounter-item').remove();
        $selectPlayer.find("option[value='" + id + "']").removeAttr('disabled');
      });
    } catch (e) {
      console.error('error: ajax apiPathfinderPlayers: ' + e);
    }
  });
  
  $('#add-encounter-bestiary').on('click', function () {
    let idBestiary = $selectBestiary.val();

    if (idBestiary == "") {
      return;
    }

    let bestiary = findBestiary(idBestiary);

    try {
      if (bestiary == null) {
        return;
      }

      $newEncounterBestiary = $protoEncounterBestiary.clone();
      $newEncounterBestiaryRemove = $newEncounterBestiary.find('.selected-encounter-item-bestiary-remove');

      $newEncounterBestiary.attr('data-id-item', bestiary.id);
      $newEncounterBestiary.data('id-item', bestiary.id);
      $newEncounterBestiary.find('.name').empty().append(bestiary.name + ' (lvl&nbsp;:&nbsp;' + bestiary.level + ')');
      $newEncounterBestiary.find('.level').val(bestiary.level);
      $newEncounterBestiary.find('.initiation').val(bestiary.initiation).attr('disabled','disabled');
      $newEncounterBestiary.find('.pv').empty().append(bestiary.lifePoint);
      $newEncounterBestiary.find('.info').val(bestiary.info);
      $newEncounterBestiary.find('.sheet').val(bestiary.sheet);
      $newEncounterBestiaryRemove.data('id-item', bestiary.id);
      $newEncounterBestiaryRemove.attr('data-id-item', bestiary.id);
      $newEncounterBestiary.removeClass('hide');
      $listEncounterBestiary.append($newEncounterBestiary);

      $newEncounterBestiaryRemove.click(function () {
        $(this).closest('.selected-encounter-item').remove();
      });
    } catch (e) {
      console.error('error: ajax apiPathfinderBestiaries: ' + e);
    }
  });

  $('#clear-combat-tracker').on('click', function () {
    $listingSelectedEncounter.empty();
    $pathfinderRound.empty().append(0);
    $pathfinderTotalXP.empty().append(0);
    $listEncounterBestiary.empty();
  });

  $('#start-combat-tracker').on('click', function () {
    let lvlPlayers = 0;
    let totalXP = 0;
    let listencounter = [];
    $listingSelectedEncounter.empty();

    $listEncounterPlayer.find('.selected-encounter-item').each(function() {
      listencounter.push({
        'id': $(this).attr('data-id-item'),
        'name': $(this).find('.name').text(),
        'level': $(this).find('.level').val(),
        'initiation': $(this).find('.initiation').val(),
        'lifePoint': $(this).find('.pv').text()
      });

      lvlPlayers += Math.floor($(this).find('.level').val());
    });

    nbPlayers = listencounter.length;
    lvlAveragePlayes = Math.floor(lvlPlayers/nbPlayers);

    $listEncounterBestiary.find('.selected-encounter-item').each(function() {
      roleBestiary = (Math.floor(Math.random() * 19) + 1);
      listencounter.push({
        'id': $(this).attr('data-id-item'),
        'name': $(this).find('.name').text(),
        'level': $(this).find('.level').val(),
        'roleBestiary': roleBestiary,
        'initiation': (roleBestiary + Math.floor($(this).find('.initiation').val())),
        'lifePoint': $(this).find('.pv').text(),
        'info': $(this).find('.info').val(),
        'sheet': $(this).find('.sheet').val()
      });

      totalXP += calculeXPBestiary(Math.floor($(this).find('.level').val()), lvlAveragePlayes);
    });


    listencounter = listencounter.sort(function(a, b) {
      return a.initiation - b.initiation;
    }).reverse();

    maxEncounter = listencounter.length;
    listencounter.forEach(function(encounter,index){
      $newEncounter = $protoEncounter.clone();
      $newEncounter.attr('data-id-item', encounter.id);
      $newEncounter.data('id-item', encounter.id);
      $newEncounter.find('.name').empty().append(encounter.name);
      $newEncounter.find('.initiation div').empty().append(encounter.initiation);
      if (encounter.roleBestiary) {
        $newEncounter.find('.initiation div').append('<br>(' + encounter.roleBestiary + ')');
      }
      $newEncounter.find('.current-pv input').val(encounter.lifePoint);
      $newEncounter.find('.pv').empty().append(encounter.lifePoint);
      $newEncounter.removeClass('hide');

      if (encounter.info) {
        $newEncounter.find('.info-encounter div').empty().append(encounter.info);
      }

      if (encounter.sheet) {
        $newEncounter.find('.sheet-encounter').removeClass('hide').on('click', function () {
          showModalSheetBestiary(encounter.id);
        });
      }

      if (index==0) {
        $newEncounter.find('.current-played').removeClass('hide').addClass('is-current-played').addClass('is-first-encounter');
      }

      if (index==maxEncounter-1) {
        $newEncounter.find('.current-played').addClass('is-last-encounter');
      }

      $listingSelectedEncounter.append($newEncounter);
    });

    $pathfinderRound.empty().append(1);
    $pathfinderTotalXP.empty().append(totalXP);
    $pathfinderTypeEncounter.empty().append('(' + calculeTypeEncounter(totalXP, nbPlayers) + ')');
  });

  $('#next-combat-tracker').on('click', function () {
    let $isCurrentPlayed = $('.is-current-played');
    $isCurrentPlayed.addClass('hide').removeClass('is-current-played');
    if ($isCurrentPlayed.hasClass('is-last-encounter')) {
      $isCurrentPlayed.closest('#listing-selected-encounter').find('.is-first-encounter').removeClass('hide').addClass('is-current-played');
      let currentRound = Math.floor($pathfinderRound.text());
      $pathfinderRound.empty().append(currentRound+1);
    } else {
      $isCurrentPlayed.closest('tr.selected-encounter-item').next().find('.current-played').removeClass('hide').addClass('is-current-played');
    }
  });

  $('#collapseSelectEncounter').on('hidden.bs.collapse', function () {
    $('.glyphicon.glyphicon-resize-full').addClass('hide');
    $('.glyphicon.glyphicon-resize-small').removeClass('hide');
    $('#block-encounter').removeClass('col-md-5').addClass('col-md-11');
  });

  $('#collapseSelectEncounter').on('show.bs.collapse', function () {
    $('.glyphicon.glyphicon-resize-small').addClass('hide');
    $('.glyphicon.glyphicon-resize-full').removeClass('hide');
    $('#block-encounter').removeClass('col-md-11').addClass('col-md-5');
  });

  $('#collapseSelectEncounter').collapse('show');

  initDataTracker();
});
