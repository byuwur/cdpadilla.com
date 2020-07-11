(function() {
	"use strict";
	var by = {};
	/** Pre Load */
	var loading = document.getElementById("loading");
	by.WebLoad = function() {
		if (loading.style.visibility == "hidden" || loading.style.display == "none") {
			loading.style.visibility = "visible"; loading.style.opacity = "1"; //loading.style.display = "block";
		} else {
			loading.style.visibility = "hidden"; loading.style.opacity = "0"; //loading.style.display = "none";
		}
	};

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (
				isMobile.Android() ||
				isMobile.BlackBerry() ||
				isMobile.iOS() ||
				isMobile.Opera() ||
				isMobile.Windows()
			);
		}
	};

	var fullHeight = function() {
		if (!isMobile.any()) {
			$(".js-fullheight").css("height", $(window).height());
			$(window).resize(function() {
				$(".js-fullheight").css("height", $(window).height());
			});
		}
	};

	// Animations
	var contentWayPoint = function() {
		var i = 0;
		$(".animate-box").waypoint(
			function(direction) {
				if (
					direction === "down" &&
					!$(this.element).hasClass("animated")
				) {
					i++;
					$(this.element).addClass("item-animate");
					setTimeout(function() {
						$("body .animate-box.item-animate").each(function(k) {
							var el = $(this);
							setTimeout(
								function() {
									var effect = el.data("animate-effect");
									if (effect === "fadeIn") {
										el.addClass("fadeIn animated");
									} else if (effect === "fadeInLeft") {
										el.addClass("fadeInLeft animated");
									} else if (effect === "fadeInRight") {
										el.addClass("fadeInRight animated");
									} else {
										el.addClass("fadeInUp animated");
									}
									el.removeClass("item-animate");
								},
								k * 111,
								"easeInOutExpo"
							);
						});
					}, 111);
				}
			},
			{
				offset: "85%"
			}
		);
	};

	var burgerMenu = function() {
		$(".js-mnm-nav-toggle").on("click", function(event) {
			event.preventDefault();
			var $this = $(this);
			if ($("body").hasClass("offcanvas")) {
				$this.removeClass("active");
				$("body").removeClass("offcanvas");
			} else {
				$this.addClass("active");
				$("body").addClass("offcanvas");
			}
		});
	};

	// Click outside of offcanvass
	var mobileMenuOutsideClick = function() {
		$(document).click(function(e) {
			var container = $("#mnm-aside, .js-mnm-nav-toggle");
			if (
				!container.is(e.target) &&
				container.has(e.target).length === 0
			) {
				if ($("body").hasClass("offcanvas")) {
					$("body").removeClass("offcanvas");
					$(".js-mnm-nav-toggle").removeClass("active");
				}
			}
		});
		$(window).scroll(function() {
			if ($("body").hasClass("offcanvas")) {
				$("body").removeClass("offcanvas");
				$(".js-mnm-nav-toggle").removeClass("active");
			}
		});
	};

	var sliderMain = function() {
		$("#mnm-hero .flexslider").flexslider({
			animation: "fade",
			slideshowSpeed: 8888,
			directionNav: true,
			start: function() {
				setTimeout(function() {
					$(".slider-text").removeClass("animated fadeInUp");
					$(".flex-active-slide")
						.find(".slider-text")
						.addClass("animated fadeInUp");
				}, 111);
			},
			before: function() {
				setTimeout(function() {
					$(".slider-text").removeClass("animated fadeInUp");
					$(".flex-active-slide")
						.find(".slider-text")
						.addClass("animated fadeInUp");
				}, 111);
			}
		});
	};

	var stickyFunction = function() {
		var h = $(".image-content").outerHeight();
		if ($(window).width() <= 801) {
			$("#sticky_item").trigger("sticky_kit:detach");
		} else {
			$(".sticky-parent").removeClass("stick-detach");
			$("#sticky_item").trigger("sticky_kit:detach");
			$("#sticky_item").trigger("sticky_kit:unstick");
			if ($("body").hasClass("offcanvas")) {
				setTimeout(function() {
					$("body").removeClass("offcanvas");
					$(".js-mnm-nav-toggle").removeClass("active");
				}, 1);
			}
		}
		if ($(window).height() <= 451) {
			$("#sticky_item").trigger("sticky_kit:detach");
		} else {
			$(".sticky-parent").removeClass("stick-detach");
			$("#sticky_item").trigger("sticky_kit:detach");
			$("#sticky_item").trigger("sticky_kit:unstick");
		}
		$(window).resize(function() {
			var h = $(".image-content").outerHeight();
			$(".sticky-parent").css("height", h);
			if ($(window).width() <= 801) {
				$("#sticky_item").trigger("sticky_kit:detach");
			} else {
				$(".sticky-parent").removeClass("stick-detach");
				$("#sticky_item").trigger("sticky_kit:detach");
				$("#sticky_item").trigger("sticky_kit:unstick");
				$("#sticky_item").stick_in_parent();
				if ($("body").hasClass("offcanvas")) {
					setTimeout(function() {
						$("body").removeClass("offcanvas");
						$(".js-mnm-nav-toggle").removeClass("active");
					}, 1);
				}
			}
			if ($(window).height() <= 451) {
				$("#sticky_item").trigger("sticky_kit:detach");
			} else {
				$(".sticky-parent").removeClass("stick-detach");
				$("#sticky_item").trigger("sticky_kit:detach");
				$("#sticky_item").trigger("sticky_kit:unstick");
				$("#sticky_item").stick_in_parent();
			}
		});
		$(".sticky-parent").css("height", h);
		$("#sticky_item").stick_in_parent();
	};
	// Document on load.
	$(function() {
		fullHeight();
		contentWayPoint();
		burgerMenu();
		mobileMenuOutsideClick();
		sliderMain();
		stickyFunction();
	});

	// Window on Load
	$(window).on("load", function() {
		by.WebLoad();
	});

})();

function active_home() {
	var li_sidebar = document.getElementsByClassName("mnm-active");
	// Removes active class from other elements
	for (var i = 0; i < li_sidebar.length; i++) li_sidebar[i].className = "";
	// Adds active class to clicked li
	document.getElementById("li_home").className = "mnm-active";
	// Closes responsive menu when a scroll trigger link is clicked half a second after
	if ($("body").hasClass("offcanvas")) {
		setTimeout(function() {
			$("body").removeClass("offcanvas");
			$(".js-mnm-nav-toggle").removeClass("active");
		}, 0);
	}
}

function active_work() {
	var li_sidebar = document.getElementsByClassName("mnm-active");
	for (var i = 0; i < li_sidebar.length; i++) li_sidebar[i].className = "";
	document.getElementById("li_work").className = "mnm-active";
	if ($("body").hasClass("offcanvas")) {
		setTimeout(function() {
			$("body").removeClass("offcanvas");
			$(".js-mnm-nav-toggle").removeClass("active");
		}, 0);
	}
}

function active_services() {
	var li_sidebar = document.getElementsByClassName("mnm-active");
	for (var i = 0; i < li_sidebar.length; i++) li_sidebar[i].className = "";
	document.getElementById("li_services").className = "mnm-active";
	if ($("body").hasClass("offcanvas")) {
		setTimeout(function() {
			$("body").removeClass("offcanvas");
			$(".js-mnm-nav-toggle").removeClass("active");
		}, 0);
	}
}

function active_about() {
	var li_sidebar = document.getElementsByClassName("mnm-active");
	for (var i = 0; i < li_sidebar.length; i++) li_sidebar[i].className = "";
	document.getElementById("li_about").className = "mnm-active";
	if ($("body").hasClass("offcanvas")) {
		setTimeout(function() {
			$("body").removeClass("offcanvas");
			$(".js-mnm-nav-toggle").removeClass("active");
		}, 0);
	}
}

function active_contact() {
	var li_sidebar = document.getElementsByClassName("mnm-active");
	for (var i = 0; i < li_sidebar.length; i++) li_sidebar[i].className = "";
	document.getElementById("li_contact").className = "mnm-active";
	if ($("body").hasClass("offcanvas")) {
		setTimeout(function() {
			$("body").removeClass("offcanvas");
			$(".js-mnm-nav-toggle").removeClass("active");
		}, 0);
	}
}
