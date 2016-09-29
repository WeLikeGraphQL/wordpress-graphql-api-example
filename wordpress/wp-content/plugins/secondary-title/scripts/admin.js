jQuery(document).ready(
    function () {
        var secondaryTitleInput, inputPosition, titleWrap, titleFormatValue, titleFormat, titleFormatPreview, autoShowOnDescription, autoShowOffDescription, categories, postbox, inside, togglerIcon;

        function toggleAutoShowDescription() {
            if (jQuery("#auto-show-off").is(":checked")) {
                autoShowOnDescription.hide();
                autoShowOffDescription.fadeIn();
            } else {
                autoShowOffDescription.hide();
                autoShowOnDescription.fadeIn();
            }
        }

        function updateTitleFormatPreview() {
            var randomPostTitle, randomPostSecondaryTitle;

            randomPostTitle          = jQuery("#random-post-title").attr("value");
            randomPostSecondaryTitle = jQuery("#random-post-secondary-title").attr("value");

            if (jQuery("#title-format-preview").length < 1) {
                return false;
            }

            setTimeout(
                function () {
                    titleFormatPreview = jQuery("#title-format-preview");
                    titleFormat        = jQuery("#title-format");
                    titleFormatValue   = titleFormat.val();
                    titleFormatValue   = titleFormatValue.replace(/\%title\%/g, randomPostTitle);
                    titleFormatValue   = titleFormatValue.replace(/\%secondary_title\%/g, randomPostSecondaryTitle);

                    titleFormatPreview.find(".text-field").html(titleFormatValue);
                }, 50
            );
        }

        /** Display the secondary title on edit/new post screen */
        jQuery("#title").ready(
            function () {
                secondaryTitleInput = jQuery("#secondary-title-input");
                inputPosition       = jQuery("#secondary-title-input-position").attr("value");
                titleWrap           = jQuery("#titlewrap");

                if (inputPosition === "above") {
                    secondaryTitleInput.insertBefore(titleWrap).show();
                } else if (inputPosition === "below") {
                    secondaryTitleInput.insertAfter("#title").show();
                }
            }
        );

        if (jQuery("#secondary-title-settings").length > 0) {
            autoShowOffDescription = jQuery("#auto-show-off-description");
            autoShowOnDescription  = jQuery("#auto-show-on-description");
            titleFormat            = jQuery("#title-format");
            titleFormatPreview     = jQuery("#title-format-preview");
            categories             = jQuery("#row-categories").find("input");

            /** Update the title format preview on page load */
            updateTitleFormatPreview();

            /** Toggle description for "Auto show" setting */
            toggleAutoShowDescription();

            if (jQuery(".updated").length > 0) {
                setTimeout(
                    function () {
                        jQuery(".updated").fadeOut();
                    }, 10000
                );
            }

            jQuery("#select-all-categories").click(
                function () {
                    categories.attr("checked", "checked");

                    jQuery("#select-all-categories-container").hide();
                    jQuery("#unselect-all-categories-container").show();

                    return false;
                }
            );

            jQuery("#unselect-all-categories").click(
                function () {
                    categories.removeAttr("checked");
                    jQuery("#select-all-categories-container").show();
                    jQuery("#unselect-all-categories-container").hide();

                    return false;
                }
            );

            jQuery("#show-all-categories").click(
                function () {
                    jQuery("#row-categories").find(".list-item").show();

                    return false;
                }
            );

            jQuery("#reset-title-format").click(
                function () {
                    jQuery("#title-format").attr("value", jQuery("#title-format-backup").attr("value"));
                    return false;
                }
            );

            jQuery(".reset-button").click(
                function () {
                    if (!confirm(jQuery("#text-confirm-reset").attr("value"))) {
                        return false;
                    }
                }
            );

            jQuery(".content-toggler, .postbox-title").click(
                function () {
                    postbox     = jQuery(this).parents(".postbox");
                    inside      = postbox.find(".inside");
                    togglerIcon = postbox.find(".content-toggler");

                    if (postbox.find(".opened").length > 0) {
                        inside.slideUp();
                        inside.removeClass("opened");
                        togglerIcon.css("transform", "rotate(180deg)");
                    } else {
                        inside.slideDown();
                        inside.addClass("opened");
                        togglerIcon.css("transform", "rotate(0deg)");
                    }
                }
            );

            jQuery("#row-auto-show").find("input").click(
                function () {
                    toggleAutoShowDescription();
                }
            );

            jQuery("#row-title-format").find("input").keyup(
                function () {
                    updateTitleFormatPreview();
                }
            );

            jQuery("code.pointer").click(
                function () {
                    titleFormat = jQuery("#title-format");

                    titleFormat.attr("value", titleFormat.attr("value") + jQuery(this).text());

                    updateTitleFormatPreview();
                }
            );
        }
    }
);