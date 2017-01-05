$ ->

    # On cache les champs lies
    $(".js_input_toggle").each (num, element) ->
        selectToggle($(element), $("." + target)) for target in $(element).data("target-input").split(" ")

    # Puis on ecoute les evenements
    $("form").delegate ".js_input_toggle", "change", (event) ->
        selectToggle($(event.currentTarget), $("." + element)) for element in $(event.currentTarget).data("target-input").split(" ")


selectToggle = (trigger, input) ->
    # Pas le meme traitement si checkbox ou select
    if trigger.is("select")
        value = trigger.val()
    else
        value = $(trigger).find("input:checked").val()

    # On verifie la valeur
    if not value || value is "" || value == "Dès que possible" || value == "no"
        input.closest(".certificationsInput").hide()
        input.closest(".control-group input").removeAttr("required")
    else
        input.closest(".certificationsInput").show()
        input.closest(".control-group input").attr("required", "required")
