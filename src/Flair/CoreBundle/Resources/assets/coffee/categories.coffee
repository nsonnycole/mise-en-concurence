$ ->
    $(".js_categories").delegate "select", "change", (event) ->
        $.post(
            $(".js_categories").data("url"),
            $(".js_categories select").serialize(),
            (data) ->
                $(".js_categories").html(data)
                $("#inscription_organisme_form_categorieLevelTwo, #inscription_organisme_form_categorieLevelOne").unbind "change";
                $("#inscription_organisme_form_categorieLevelTwo, #inscription_organisme_form_categorieLevelOne").bind "change", ->
                    initCategories()
        )
        event.preventDefault()

    initCategories = ->
        if $("#inscription_organisme_form_categorieLevelTwo option:selected").text() == "Association" and $("#inscription_organisme_form_categorieLevelOne option:selected").val() != ""
            $('#inscription_organisme_form_autreCategorie').parent().parent().hide();    
            $("#inscription_organisme_form_rna").attr('required', 'required');
            $("#rna").show(1000);
            $("#inscription_organisme_form_siren").removeAttr('required');
            $("#inscription_organisme_form_siren").parent().parent().find(".required-flag").remove();
            $("#inscription_organisme_form_siren").parent().parent().hide(1000);
            $("#inscription_organisme_form_siret").parent().parent().hide(1000);
         
            if $("#inscription_organisme_form_rna").parent().parent().find('.required-flag').length == 0
                $("#inscription_organisme_form_rna").parent().parent().find("label").append('<span class="required-flag">*</span>');
                $("#rna").show(1000);
            else
                $("#inscription_organisme_form_rna").removeAttr('required', 'required');
                $("#inscription_organisme_form_rna").parent().parent().find(".required-flag").remove();
                $("#rna").hide(1000);
                $("#inscription_organisme_form_siren").attr('required', 'required');
                $("#inscription_organisme_form_siren").parent().parent().show(1000);

                if $("#inscription_organisme_form_siren").parent().parent().find('.required-flag').length == 0
                    $("#inscription_organisme_form_siren").parent().parent().find("label").append('<span class="required-flag">*</span>');
                $("#inscription_organisme_form_siret").parent().parent().show(1000);

        else if $("#inscription_organisme_form_categorieLevelTwo option:selected").text() == "Autre" and $("#inscription_organisme_form_categorieLevelOne option:selected").val() != ""
            $("#inscription_organisme_form_rna").removeAttr('required', 'required');
            $("#inscription_organisme_form_rna").parent().parent().find(".required-flag").remove();
            $("#rna").hide(1000);
            $('#inscription_organisme_form_autreCategorie').parent().parent().show();
            if $("#inscription_organisme_form_autreCategorie").parent().parent().find('.required-flag').length == 0
                $('#inscription_organisme_form_autreCategorie').parent().parent().find('label').append('<span class="required-flag">*</span>');
                $('#inscription_organisme_form_autreCategorie input').attr('required', 'required');  
        else
            $('#inscription_organisme_form_autreCategorie').parent().parent().hide();
            $("#rna").hide(1000);
            $("#inscription_organisme_form_rna").removeAttr('required', 'required');
            $("#inscription_organisme_form_rna").parent().parent().find(".required-flag").remove();
            $("#inscription_organisme_form_siren").attr('required', 'required');
            $("#inscription_organisme_form_siren").parent().parent().show(1000);
            if $("#inscription_organisme_form_siren").parent().parent().find('.required-flag').length == 0
                $("#inscription_organisme_form_siren").parent().parent().find("label").append('<span class="required-flag">*</span>');    
            $("#inscription_organisme_form_siret").parent().parent().show(1000);

    initCategories()