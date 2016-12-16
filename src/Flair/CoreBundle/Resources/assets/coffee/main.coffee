$ ->

    # Retour en haut de page avec le scroll.
    $("body").delegate '#js-scroll-top', 'click', (event) ->
        event.preventDefault()
        event.stopPropagation()
        $('html, body').animate
            scrollTop: 0
        , "slow"

    # Activation du datepicker.
    $('.js_datepicker').datepicker($.extend($.datepicker.regional['fr'],
        showOn: 'button'
        buttonImage: '/images/calendar.gif'
        buttonImageOnly: true
    ))

    # Confirmation de la suppression
    $("body").delegate ".js_confirm", 'click', (event) ->
        window.confirm $(event.currentTarget).data("confirm")

    # Affichage de la description complete.
    $("body").delegate '.readMore', 'click', (event) ->
        $('.collapsable').toggleClass('open', 100)
        $('.readMore').replaceWith('<a href="#" class="readLess">masquer</a>')
        return false

    # Lire moins
    $("body").delegate '.readLess', 'click', (event) ->
        $('.collapsable').toggleClass('open', 100)
        $('.readLess').replaceWith('<a href="#" class="readMore">lire la suite</a>')
        return false

    # On lance le tooltip
    $('[data-title]').tooltip(
        "content" : ->
            $(this).attr('data-title')
    )

    # Utilisation du plugin de Mathias pour le placeholder.
    $('input, textarea').placeholder();

    $("#devis").hide()
    $("#devis_toggle").click (event) ->
        event.preventDefault()
        event.stopPropagation()
        $("#devis").toggle()

    $("#confirm_annulation").click (event) ->
        event.preventDefault()
        event.stopPropagation()

        $("#annulation-modal").dialog
            dialogClass: "no-close"
            resizable: false
            height: 250
            width: 350
            modal: true
            buttons:
                "non": ->
                    $(this).dialog("close")
                "oui, annuler la consultation": ->
                    $(this).dialog("close")
                    window.location.href = event.target.href

