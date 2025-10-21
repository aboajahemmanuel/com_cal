(function ($) {
	"use strict";

	if ($(".nav-tabs--with-btns").length) {
		$(".nav-tabs--with-btns").each(function () {
			let self = $(this);
			let nextBtn = self.find(".nav-tabs--btns .next a");
			let prevBtn = self.find(".nav-tabs--btns .prev a");

			nextBtn.on("click", function (e) {
				e.preventDefault();
				const nextTabLinkEl = self.find('.active').closest('li').next('li').find('button')[0];
				const nextTab = new bootstrap.Tab(nextTabLinkEl);
				nextTab.show();
			});

			prevBtn.on("click", function (e) {
				e.preventDefault();
				const prevTabLinkEl = self.find('.active').closest('li').prev('li').find('button')[0];
				const prevTab = new bootstrap.Tab(prevTabLinkEl);
				prevTab.show();
			});
		});
	}

	//adds the class
	$('.accordion-collapse').on('shown.bs.collapse', function () {
		$(this).parent().addClass('accordion--active');
	});

	//removes the class
	$('.accordion-collapse').on('hidden.bs.collapse', function () {
		$(this).parent().removeClass('accordion--active');
	});

	// ===Portfolio===
	function projectMasonaryLayout() {
		if ($(".masonary-layout").length) {
			$(".masonary-layout").isotope({
				layoutMode: "masonry"
			});
		}
		if ($(".post-filter").length) {
			$(".post-filter li")
				.children(".filter-text")
				.on("click", function () {
					var Self = $(this);
					var selector = Self.parent().attr("data-filter");
					$(".post-filter li").removeClass("active");
					Self.parent().addClass("active");
					$(".filter-layout").isotope({
						filter: selector,
						animationOptions: {
							duration: 500,
							easing: "linear",
							queue: false
						}
					});
					return false;
				});
		}

		if ($(".post-filter.has-dynamic-filters-counter").length) {
			// var allItem = $('.single-filter-item').length;
			var activeFilterItem = $(".post-filter.has-dynamic-filters-counter").find(
				"li"
			);
			activeFilterItem.each(function () {
				var filterElement = $(this).data("filter");
				var count = $(".filter-layout").find(filterElement).length;
				$(this)
					.children(".filter-text")
					.append('<span class="count">(' + count + ")</span>");
			});
		}
	}
	if ($('.datepicker').length) {
		$('.datepicker').each(function () {
			let self = $(this);
			self.datepicker({
				'format': 'd M yyyy',
			});
		});
	}
	if ($(".contact-two__progress-range").length) {
		$(".contact-two__progress-range").each(function () {
			let balanceTag = $(this).find(".contact-two__balance span");
			let balanceInput = $(this).find(".contact-two__balance__input");
			$(this).find(".balance-range-slider").ionRangeSlider({
				onStart: function (data) {
					balanceTag.html(data.from);
					balanceInput.prop("value", data.from);
				},
				onChange: function (data) {
					balanceTag.html(data.from);
					balanceInput.prop("value", data.from);
				}
			});
		});
	}
	if ($('.niceselect').length) {
		$('.niceselect').niceSelect();
	}
	if ($(".video-popup").length) {
		$('.video-popup').YouTubePopUp();
	}
	//Fact Counter + Text Count
	if ($(".count-box").length) {
		$(".count-box").appear(
			function () {
				var $t = $(this),
					n = $t.find(".count-text").attr("data-stop"),
					r = parseInt($t.find(".count-text").attr("data-speed"), 10);

				if (!$t.hasClass("counted")) {
					$t.addClass("counted");
					$({
						countNum: $t.find(".count-text").text()
					}).animate({
						countNum: n
					}, {
						duration: r,
						easing: "linear",
						step: function () {
							$t.find(".count-text").text(Math.floor(this.countNum));
						},
						complete: function () {
							$t.find(".count-text").text(this.countNum);
						}
					});
				}
			}, {
				accY: 0
			}
		);
	}
	if ($(".count-bar").length) {
		$(".count-bar").appear(
			function () {
				var el = $(this);
				var percent = el.data("percent");
				$(el).css("width", percent).addClass("counted");
			}, {
				accY: -50
			}
		);
	}
	if ($(".count-bar--no-appear").length) {
		$(".count-bar--no-appear").each(
			function () {
				var el = $(this);
				var percent = el.data("percent");
				$(el).css("width", percent).addClass("counted");
			}
		);
	}
	if ($(".img-popup").length) {
		var groups = {};
		$(".img-popup").each(function () {
			var id = parseInt($(this).attr("data-group"), 10);

			if (!groups[id]) {
				groups[id] = [];
			}

			groups[id].push(this);
		});

		$.each(groups, function () {
			$(this).magnificPopup({
				type: "image",
				closeOnContentClick: true,
				closeBtnInside: false,
				gallery: {
					enabled: true
				}
			});
		});
	}

	let thmOwlCarousels = $(".thm-owl__carousel");
	if (thmOwlCarousels.length) {
		thmOwlCarousels.each(function () {
			let elm = $(this);
			let options = elm.data("owl-options");
			let thmOwlCarousel = elm.owlCarousel(
				"object" === typeof options ? options : JSON.parse(options)
			);
		});
	}

	let thmOwlNavCarousels = $(".thm-owl__carousel--custom-nav");
	if (thmOwlNavCarousels.length) {
		thmOwlNavCarousels.each(function () {
			let elm = $(this);
			let owlNavPrev = elm.data("owl-nav-prev");
			let owlNavNext = elm.data("owl-nav-next");
			$(owlNavPrev).on("click", function (e) {
				elm.trigger("prev.owl.carousel");
				e.preventDefault();
			});

			$(owlNavNext).on("click", function (e) {
				elm.trigger("next.owl.carousel");
				e.preventDefault();
			});
		});
	}

	// mailchimp form
	if ($(".mc-form").length) {
		$(".mc-form").each(function () {
			var Self = $(this);
			var mcURL = Self.data("url");
			var mcResp = Self.parent().find(".mc-form__response");

			Self.ajaxChimp({
				url: mcURL,
				callback: function (resp) {
					// appending response
					mcResp.append(function () {
						return '<p class="mc-message">' + resp.msg + "</p>";
					});
					// making things based on response
					if (resp.result === "success") {
						// Do stuff
						Self.removeClass("errored").addClass("successed");
						mcResp.removeClass("errored").addClass("successed");
						Self.find("input").val("");

						mcResp.find("p").fadeOut(10000);
					}
					if (resp.result === "error") {
						Self.removeClass("successed").addClass("errored");
						mcResp.removeClass("successed").addClass("errored");
						Self.find("input").val("");

						mcResp.find("p").fadeOut(10000);
					}
				}
			});
		});
	}
	if ($(".contact-form-validated").length) {
		$(".contact-form-validated").each(function () {
			let contactForm = $(this);
			contactForm.validate({
				// initialize the plugin
				rules: {
					name: {
						required: true
					},
					phone: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
					message: {
						required: true
					},
					subject: {
						required: true
					}
				},
				submitHandler: function (form) {
					// sending value with ajax request
					$.post(
						$(form).attr("action"),
						$(form).serialize(),
						function (response) {
							$(form).parent().find(".result").append(response);
							$(form).find('input[type="text"]').val("");
							$(form).find('input[type="email"]').val("");
							$(form).find("textarea").val("");
						}
					);
					return false;
				}
			});
		});
	}


	function dynamicCurrentMenuClass(selector) {
		let FileName = window.location.href.split("/").reverse()[0];

		selector.find("li").each(function () {
			let anchor = $(this).find("a");
			if ($(anchor).attr("href") == FileName) {
				$(this).addClass("current");
			}
		});
		// if any li has .current elmnt add class
		selector.children("li").each(function () {
			if ($(this).find(".current").length) {
				$(this).addClass("current");
			}
		});
		// if no file name return
		if ("" == FileName) {
			selector.find("li").eq(0).addClass("current");
		}
	}

	if ($(".main-menu__list").length) {
		// dynamic current class
		let mainNavUL = $(".main-menu__list");
		dynamicCurrentMenuClass(mainNavUL);
	}

	if ($(".main-menu__list").length && $(".mobile-nav__container").length) {
		$(".main-menu__list").clone().removeClass('main-menu__list').addClass('mobile-menu__list').appendTo('.mobile-nav__container');
	}
	if ($(".sticky-header").length) {
		$(".sticky-header").clone().insertAfter('.sticky-header').addClass('sticky-header--cloned');
	}

	if ($(".mobile-menu__list").length) {
		let dropdownAnchor = $(".mobile-menu__list .menu-item-has-children > a");
		dropdownAnchor.each(function () {
			let self = $(this);
			let toggleBtn = document.createElement("BUTTON");
			toggleBtn.setAttribute("aria-label", "dropdown toggler");
			toggleBtn.innerHTML = "<i class='fa fa-angle-down'></i>";
			self.append(function () {
				return toggleBtn;
			});
			self.find("button").on("click", function (e) {
				e.preventDefault();
				let self = $(this);
				self.toggleClass("expanded");
				self.parent().toggleClass("expanded");
				self.parent().parent().children("ul").slideToggle();
			});
		});
	}

	if ($(".mobile-nav__toggler").length) {
		$(".mobile-nav__toggler").on("click", function (e) {
			e.preventDefault();
			$(".mobile-nav__wrapper").toggleClass("expanded");
			$("body").toggleClass("locked");
		});
	}

	if ($(".side-drawer__toggler").length) {
		$(".side-drawer__toggler").on("click", function (e) {
			e.preventDefault();
			$(".side-drawer__wrapper").toggleClass("expanded");
			$("body").toggleClass("locked");
		});
	}

	if ($(".search-toggler").length) {
		$(".search-toggler").on("click", function (e) {
			e.preventDefault();
			$(".search-popup").toggleClass("active");
			$(".mobile-nav__wrapper").removeClass("expanded");
			$("body").toggleClass("locked");
		});
	}

	if ($(".scroll-to-target").length) {
		$(".scroll-to-target").on("click", function () {
			var target = $(this).attr("data-target");
			$("html, body").animate({
					scrollTop: $(target).offset().top,
				},
				1000
			);
			return false;
		});
	}
	if ($(".dynamic-year").length) {
		let currentYear = new Date().getFullYear();
		$(".dynamic-year").html(currentYear);
	}
	if ($(".wow").length) {
		var wow = new WOW({
			boxClass: "wow", // animated element css class (default is wow)
			animateClass: "animated", // animation css class (default is animated)
			mobile: true, // trigger animations on mobile devices (default is true)
			live: true // act on asynchronously loaded content (default is true)
		});
		wow.init();
	}

	$(window).on("scroll", function () {
		if ($(".sticky-header--cloned").length) {
			var headerScrollPos = 130;
			var stricky = $(".sticky-header--cloned");
			if ($(window).scrollTop() > headerScrollPos) {
				stricky.addClass("sticky-fixed");
			} else if ($(this).scrollTop() <= headerScrollPos) {
				stricky.removeClass("sticky-fixed");
			}
		}
		if ($(".scroll-to-top").length) {
			var strickyScrollPos = 100;
			if ($(window).scrollTop() > strickyScrollPos) {
				$(".scroll-to-top").fadeIn(500);
			} else if ($(this).scrollTop() <= strickyScrollPos) {
				$(".scroll-to-top").fadeOut(500);
			}
		}

	});

	$(window).on("load", function () {
		if ($(".preloader").length) {
			$(".preloader").fadeOut();
		}
		projectMasonaryLayout();
	});

})(jQuery);