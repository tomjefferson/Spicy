(function ($) {
  jQuery(window).on("elementor:init", function () {
    var ControlBaseMultipleItemView = elementor.modules.controls.BaseMultiple;

    var ControlMultiUnitItemView = elementor.modules.controls.BaseMultiple.extend(
      {
        ui: function () {
          var ui = ControlBaseMultipleItemView.prototype.ui.apply(
            this,
            arguments
          );
          ui.controls = ".spicy-control-multiunit > input:enabled";
          ui.link = "button.spicy-link-dimensions";
          ui.top_choices =
            "div.spicy-units-choices > input[type=radio][data-setting=top_unit]";
          ui.right_choices =
            "div.spicy-units-choices > input[type=radio][data-setting=right_unit]";
          ui.bottom_choices =
            "div.spicy-units-choices > input[type=radio][data-setting=bottom_unit]";
          ui.left_choices =
            "div.spicy-units-choices > input[type=radio][data-setting=left_unit]";
          ui.unitLink = ".spicy_link";
          ui.gear = ".spicy_link_first";
          ui.ranges_top = ".spicy-units-choices-label-top";
          ui.ranges_right = ".spicy-units-choices-label-right";
          ui.ranges_bottom = ".spicy-units-choices-label-bottom";
          ui.ranges_left = ".spicy-units-choices-label-left";
          ui.linked = ".spicy-linked";
          ui.unlinked = ".spicy-unlinked";
          return ui;
        },

        events: function () {
          return _.extend(
            ControlBaseMultipleItemView.prototype.events.apply(this, arguments),
            {
              "click @ui.ranges_top": "TopRangeToggle",
              "click @ui.ranges_right": "RightRangeToggle",
              "click @ui.ranges_bottom": "BottomRangeToggle",
              "click @ui.ranges_left": "LeftRangeToggle",
              "click @ui.link": "onLinkDimensionsClicked",
              "change @ui.top_choices": "setTopInputRange",
              "change @ui.right_choices": "setRightInputRange",
              "change @ui.bottom_choices": "setBottomInputRange",
              "change @ui.left_choices": "setLeftInputRange",
              "click @ui.unitLink": "linkUnit",
              "click @ui.gear": "gearToggle",
            }
          );
        },
        // required variable
        defaultDimensionValue: 0,
        range_control: "",
        name_control: "",
        gear_check: true,
        range_all: true,
        range_top: true,
        range_right: true,
        range_bottom: true,
        range_left: true,

        initialize: function () {
          ControlBaseMultipleItemView.prototype.initialize.apply(
            this,
            arguments
          );
          this.model.set(
            "allowed_dimensions",
            this.filterDimensions(this.model.get("allowed_dimensions"))
          );
          this.range_control = this.model.get(["range"]);
          this.name_control = this.model.get(["name"]);
        },
        // set top input range
        setTopInputRange: function (event) {
          var val = $(event.target).val();
          var min = this.range_control[val].min;
          var max = this.range_control[val].max;
          var step = this.range_control[val].step;

          $(
            "li.spicy-control-multiunit > input[type=number][data-name=" +
              this.name_control +
              "-top]"
          ).attr({ min: min, max: max, step: step });
        },
        // set right input range
        setRightInputRange: function (event) {
          var val = $(event.target).val();
          var min = this.range_control[val].min;
          var max = this.range_control[val].max;
          var step = this.range_control[val].step;

          $(
            "li.spicy-control-multiunit > input[type=number][data-name=" +
              this.name_control +
              "-right]"
          ).attr({ min: min, max: max, step: step });
        },
        // set bottom input range
        setBottomInputRange: function (event) {
          var val = $(event.target).val();
          var min = this.range_control[val].min;
          var max = this.range_control[val].max;
          var step = this.range_control[val].step;

          $(
            "li.spicy-control-multiunit > input[type=number][data-name=" +
              this.name_control +
              "-bottom]"
          ).attr({ min: min, max: max, step: step });
        },
        // set left input range
        setLeftInputRange: function (event) {
          var val = $(event.target).val();
          var min = this.range_control[val].min;
          var max = this.range_control[val].max;
          var step = this.range_control[val].step;

          $(
            "li.spicy-control-multiunit > input[type=number][data-name=" +
              this.name_control +
              "-left]"
          ).attr({ min: min, max: max, step: step });
        },
        // show/hide top ranges
        TopRangeToggle: function (event) {
          var cat = $(event.target).attr("data-cat");
          if (this.range_top == false) {
            $(".spicy-units-choices-label-top[data-cat=" + cat + "]")
              .not(event.target)
              .hide();
            this.range_top = true;
          } else if (this.range_top == true) {
            $(".spicy-units-choices-label-top[data-cat=" + cat + "]").show();
            this.range_top = false;
          }
        },
        // show/hide right ranges
        RightRangeToggle: function (event) {
          var cat = $(event.target).attr("data-cat");
          if (this.range_right == false) {
            $(".spicy-units-choices-label-right[data-cat=" + cat + "]")
              .not(event.target)
              .hide();
            this.range_right = true;
          } else if (this.range_right == true) {
            $(".spicy-units-choices-label-right[data-cat=" + cat + "]").show();
            this.range_right = false;
          }
        },
        // show/hide bottom ranges
        BottomRangeToggle: function (event) {
          var cat = $(event.target).attr("data-cat");
          if (this.range_bottom == false) {
            $("div.spicy-units-choices > label[data-cat=" + cat + "]")
              .not(event.target)
              .hide();
            this.range_bottom = true;
          } else if (this.range_bottom == true) {
            $(".spicy-units-choices-label-bottom[data-cat=" + cat + "]").show();
            this.range_bottom = false;
          }
        },
        // show/hide left ranges
        LeftRangeToggle: function (event) {
          var cat = $(event.target).attr("data-cat");
          if (this.range_left == false) {
            $(".spicy-units-choices-label-left[data-cat=" + cat + "]")
              .not(event.target)
              .hide();
            this.range_left = true;
          } else if (this.range_left == true) {
            $(".spicy-units-choices-label-left[data-cat=" + cat + "]").show();
            this.range_left = false;
          }
        },
        // show/hide gear sublink
        gearToggle: function (event) {
          event.preventDefault();
          event.stopPropagation();
          if (this.gear_check == true) {
            $(this.ui.unitLink).css("display", "inline-block");
            this.gear_check = false;
          } else {
            $(this.ui.unitLink).css("display", "none");
            this.gear_check = true;
          }
        },
        // only hide sublink
        allRangeToggle: function () {
          $(this.ui.unitLink).hide();
          this.gear_check = true;
        },
        // sync all unit
        linkUnit: function (event) {
          var text = $(event.target).text();
          $(
            "div.spicy-units-choices > input[type=radio][name=spicy-choose-" +
              this.name_control +
              "-top][value=" +
              "'" +
              text +
              "'" +
              "]"
          )
            .prop("checked", true)
            .trigger("change");
          $(
            "div.spicy-units-choices > input[type=radio][name=spicy-choose-" +
              this.name_control +
              "-right][value=" +
              "'" +
              text +
              "'" +
              "]"
          )
            .prop("checked", true)
            .trigger("change");
          $(
            "div.spicy-units-choices > input[type=radio][name=spicy-choose-" +
              this.name_control +
              "-bottom][value=" +
              "'" +
              text +
              "'" +
              "]"
          )
            .prop("checked", true)
            .trigger("change");
          $(
            "div.spicy-units-choices > input[type=radio][name=spicy-choose-" +
              this.name_control +
              "-left][value=" +
              "'" +
              text +
              "'" +
              "]"
          )
            .prop("checked", true)
            .trigger("change");
          $("div.spicy-units-choices > input[class=" + this.name_control + "]")
            .not(":checked")
            .next()
            .hide();
          $(
            "div.spicy-units-choices > input[class=" +
              this.name_control +
              "]:checked"
          )
            .next()
            .show();

          this.allRangeToggle(event);
        },

        getPossibleDimensions: function () {
          return ["top", "right", "bottom", "left"];
        },
        // interact with allowed-dimensions settings
        filterDimensions: function (filter) {
          filter = filter || "all";

          var dimensions = this.getPossibleDimensions();

          if ("all" === filter) {
            return dimensions;
          }

          if (!_.isArray(filter)) {
            if ("horizontal" === filter) {
              filter = ["right", "left"];
            } else if ("vertical" === filter) {
              filter = ["top", "bottom"];
            }
          }

          return filter;
        },

        onReady: function () {
          var self = this,
            currentValue = self.getControlValue();

          if (!self.isLinkedDimensions()) {
            self.ui.link.addClass("unlinked");

            self.ui.controls.each(function (index, element) {
              var value = currentValue[element.dataset.setting];

              if (_.isEmpty(value)) {
                value = self.defaultDimensionValue;
              }

              self.$(element).val(value);
            });
          }
          self.fillEmptyDimensions();
          self.initLikButton();
        },
        // update values
        updateDimensionsValue: function () {
          var currentValue = {},
            dimensions = this.getPossibleDimensions(),
            $controls = this.ui.controls,
            defaultDimensionValue = this.defaultDimensionValue;

          dimensions.forEach(function (dimension) {
            var $element = $controls.filter(
              '[data-setting="' + dimension + '"]'
            );

            currentValue[dimension] = $element.length
              ? $element.val()
              : defaultDimensionValue;
          });

          this.setValue(currentValue);
        },
        // fill empty dimension
        fillEmptyDimensions: function () {
          var dimensions = this.getPossibleDimensions(),
            allowedDimensions = this.model.get("allowed_dimensions"),
            $controls = this.ui.controls,
            defaultDimensionValue = this.defaultDimensionValue;

          if (this.isLinkedDimensions()) {
            return;
          }

          dimensions.forEach(function (dimension) {
            var $element = $controls.filter(
                '[data-setting="' + dimension + '"]'
              ),
              isAllowedDimension =
                -1 !== _.indexOf(allowedDimensions, dimension);

            if (
              isAllowedDimension &&
              $element.length &&
              _.isEmpty($element.val())
            ) {
              $element.val(defaultDimensionValue);
            }
          });
        },
        // initial link button
        initLikButton: function () {
          if (this.isLinkedDimensions()) {
            this.ui.unlinked.hide();
            this.ui.linked.show();
            this.ui.linked.css("color", "white");
          } else {
            this.ui.linked.hide();
            this.ui.unlinked.show();
            this.ui.link.css("background-color", "white");
          }
        },
        // update Dimensions
        updateDimensions: function () {
          this.fillEmptyDimensions();
          this.updateDimensionsValue();
        },
        // clear input
        resetDimensions: function () {
          this.ui.controls.val("");

          this.updateDimensionsValue();
        },
        // run while inputs change
        onInputChange: function (event) {
          var inputSetting = event.target.dataset.setting;

          if ("unit" === inputSetting) {
            this.resetDimensions();
          }

          if (!_.contains(this.getPossibleDimensions(), inputSetting)) {
            return;
          }

          if (this.isLinkedDimensions()) {
            var $thisControl = this.$(event.target);

            this.ui.controls.val($thisControl.val());
          }

          this.updateDimensions();
        },
        // run while click on link button
        onLinkDimensionsClicked: function (event) {
          event.preventDefault();
          event.stopPropagation();
          if (this.isLinkedDimensions()) {
            this.ui.linked.hide();
            this.ui.unlinked.show();
            this.ui.linked.css("color", "black");
            this.ui.link.css("background-color", "white");
            this.setValue("isLinked", false);
          } else {
            // Set all controls value from the first control.
            this.ui.controls.val(this.ui.controls.eq(0).val());
            this.setValue("isLinked", true);
            this.ui.unlinked.hide();
            this.ui.linked.css("color", "white");
            this.ui.link.css("background-color", "#7a8791");
            this.ui.linked.show();
          }
          this.updateDimensions();
        },
        // determine dimension is linked or not
        isLinkedDimensions: function () {
          return this.getControlValue("isLinked");
        },
      }
    );

    elementor.addControlView(
      "spicy-multi-unit-control",
      ControlMultiUnitItemView
    );
  });
})(jQuery);
