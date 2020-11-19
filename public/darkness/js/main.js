var CRUMINA = {};
!function (o) {
    "use strict";
    var e = o (window), t = o (document), s = o ("#site-header"), a = o (".crumina-countdown-number"),
        i = o ("#primary-menu"), n = o ("#hellopreloader");
    CRUMINA.preloader = function () {
        return e.scrollTop (0), setTimeout (function () {
            n.fadeOut (800)
        }, 500), !1
    }, CRUMINA.countdowns = function () {
        a.each (function () {
            o (this).TimeCircles ({
                circle_bg_color   : "transparent",
                animation_interval: "ticks",
                number_size       : .36,
                text_size         : .12,
                time              : {
                    Days   : {color: "transparent"},
                    Hours  : {color: "transparent"},
                    Minutes: {color: "transparent"},
                    Seconds: {color: "transparent"}
                }
            })
        })
    }, o (".crumina-accordion button").on ("click", function () {
        var e = o (this).closest (".card").find (".collapse").hasClass ("show");
        o (this).closest (".crumina-accordion").find (".card-header").removeClass ("active"), e ? o (this).parents (".card-header").removeClass ("active") : o (this).parents (".card-header").toggleClass ("active")
    }), CRUMINA.select2LS = function () {
        o (".language-switcher").on ("select2:select", function (e) {
            var t = e.params.data, a = jQuery (t.element);
            if (a.length && !0 === t.selected && !0 !== t.disabled) {
                var i = a.data ("href");
                i && (location.href = i)
            }
        })
    }, CRUMINA.select2Init = function () {
        o (".puzzle--select").select2 ()
    }, CRUMINA.primaryMenu = function () {
        i.crumegamenu ({
            showSpeed           : 200,
            hideSpeed           : 200,
            trigger             : "hover",
            animation           : "none",
            effect              : "fade",
            indicatorFirstLevel : "",
            indicatorSecondLevel: ""
        })
    }, CRUMINA.fixedHeader = function () {
        var e = o (".header--sticky");
        o (document).on ("scroll", function () {
            100 < o (document).scrollTop () ? e.addClass ("header--fixed") : e.removeClass ("header--fixed")
        })
    }, CRUMINA.headerSpacer = {
        $spacer  : null, $header: null, init: function () {
            this.$header = jQuery (".header--sticky"), this.$spacer = jQuery ('<div class="header--spacer"></div>').insertAfter (this.$header)
        }, resize: function () {
            var a = this;
            a.$spacer && setTimeout (function () {
                var e = a.$header.outerHeight (), t = a.$header.css ("background-color");
                a.$spacer.css ({height: e + "px", "background-color": t})
            }, 100)
        }
    }, CRUMINA.maps = {
        maps                : {
            candidates: {
                config : {
                    id     : "map-candidate",
                    map    : {
                        center : new L.LatLng (-37.613611, 144.963056),
                        zoom   : 10,
                        maxZoom: 18,
                        layers : new L.tileLayer ("https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png", {
                            maxZoom    : 18,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        })
                    },
                    icon   : {
                        iconSize   : [60, 60],
                        iconAnchor : [22, 94],
                        popupAnchor: [-3, -76],
                        className  : "icon-candidate"
                    },
                    cluster: {iconSize: [40, 40]}
                },
                markers: [{
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.813611, 144.963056],
                    icon  : "author1.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.713611, 144.863056],
                    icon  : "author2.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.713611, 145.5],
                    icon  : "author3.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.893611, 144.773056],
                    icon  : "author4.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.873611, 145.1],
                    icon  : "author11.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.753611, 144.943056],
                    icon  : "author6.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.633611, 145.3],
                    icon  : "author7.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.813611, 145.4056],
                    icon  : "author8.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.613611, 144.993056],
                    icon  : "author9.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.613611, 144.873056],
                    icon  : "author10.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.73611, 145.183056],
                    icon  : "author11.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.883611, 144.693056],
                    icon  : "author12.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.833611, 145.503056],
                    icon  : "author13.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.813611, 144.163056],
                    icon  : "author14.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.793611, 144.863056],
                    icon  : "author15.jpg"
                }, {
                    popup : '<a href="#" class="link--uppercase-wide fs-12">Designer</a><h6>Russell Wright</h6><div class="vacancies-location">Melbourne, Australia</div><a href=\'10_candidate_details.html\' class="crumina-button button--dark button--s button--with-icon button--icon-right">View profile<i class="puzzle-icon far fa-angle-right"></i></a>',
                    coords: [-37.713611, 145.083056],
                    icon  : "author16.jpg"
                }]
            },
            employers : {
                config : {
                    id     : "map-employer",
                    map    : {
                        center : new L.LatLng (-37.613611, 144.963056),
                        zoom   : 10,
                        maxZoom: 18,
                        layers : new L.tileLayer ("https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png", {
                            maxZoom    : 18,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        })
                    },
                    icon   : {iconSize: [24, 30], iconAnchor: [22, 94], popupAnchor: [-3, -76], className: ""},
                    cluster: {iconSize: [40, 49]}
                },
                markers: [{
                    popup : '<img class="logo" src="./img/client4.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.813611, 144.963056],
                    icon  : "leaf-green.png"
                }, {
                    popup : '<img class="logo" src="./img/client1.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.713611, 144.863056],
                    icon  : "leaf-green.png"
                }, {
                    popup : '<img class="logo" src="./img/client2.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.713611, 145.5],
                    icon  : "leaf-green.png"
                }, {
                    popup : '<img class="logo" src="./img/client3.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.893611, 144.773056],
                    icon  : "leaf-red.png"
                }, {
                    popup : '<img class="logo" src="./img/client4.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.873611, 145.1],
                    icon  : "leaf-red.png"
                }, {
                    popup : '<img class="logo" src="./img/client1png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.753611, 144.943056],
                    icon  : "leaf-red.png"
                }, {
                    popup : '<img class="logo" src="./img/client2.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.633611, 145.3],
                    icon  : "leaf-red.png"
                }, {
                    popup : '<img class="logo" src="./img/client3.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.813611, 145.4056],
                    icon  : "leaf-blue.png"
                }, {
                    popup : '<img class="logo" src="./img/client4.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.613611, 144.993056],
                    icon  : "leaf-blue.png"
                }, {
                    popup : '<img class="logo" src="./img/client1.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.613611, 144.873056],
                    icon  : "leaf-blue.png"
                }, {
                    popup : '<img class="logo" src="./img/client2.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.73611, 145.183056],
                    icon  : "leaf-blue.png"
                }, {
                    popup : '<img class="logo" src="./img/client3.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.883611, 144.693056],
                    icon  : "leaf-blue-dark.png"
                }, {
                    popup : '<img class="logo" src="./img/client4.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.833611, 145.503056],
                    icon  : "leaf-blue-dark.png"
                }, {
                    popup : '<img class="logo" src="./img/client1.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.813611, 144.163056],
                    icon  : "leaf-blue-dark.png"
                }, {
                    popup : '<img class="logo" src="./img/client2.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.793611, 144.863056],
                    icon  : "leaf-yellow.png"
                }, {
                    popup : '<img class="logo" src="./img/client3.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.713611, 145.083056],
                    icon  : "leaf-yellow.png"
                }, {
                    popup : '<img class="logo" src="./img/client4.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.753611, 144.533056],
                    icon  : "leaf-yellow.png"
                }, {
                    popup : '<img class="logo" src="./img/client1.png" title="company"></a><h6>Data Center Support Specialist Engineer</h6><div class="vacancies-location">Melbourne, Australia</div><button type="button" class="crumina-button button--red button--xxs button--uppercase-wide">Temporary</button>',
                    coords: [-37.93611, 145.403056],
                    icon  : "leaf-yellow.png"
                }]
            },
            contacts  : {
                config : {
                    id     : "map-contact",
                    map    : {
                        center : new L.LatLng (-37.613611, 144.963056),
                        zoom   : 10,
                        maxZoom: 18,
                        layers : new L.tileLayer ("https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png", {
                            maxZoom    : 18,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        })
                    },
                    icon   : {iconSize: [24, 30], iconAnchor: [22, 94], popupAnchor: [-3, -76], className: ""},
                    cluster: {iconSize: [40, 49]}
                },
                markers: [{
                    popup : '<img class="logo" src="./img/logo-dark.png" title="company"><div class="fs-16 mb-4">121 King Street, Melbourne Victoria 3000 Australia\n+61 3 8376 6284</div><a href=\'#\' class="crumina-button button--green button--s" data-toggle="modal" data-target="#messageModal">Send a Message</a>',
                    coords: [-37.813611, 144.963056],
                    icon  : "leaf-contact.png"
                }]
            }
        }, init             : function () {
            var n = this;
            for (var o in this.maps) {
                var s = this.maps[o];
                if (s.config && s.markers && document.getElementById (s.config.id)) {
                    var e = new L.map (s.config.id, s.config.map), r = L.markerClusterGroup ({
                        iconCreateFunction: function (e) {
                            var t = e.getChildCount (), a = s.config.cluster;
                            return new L.DivIcon ({
                                html     : "<div><span>" + t + "</span></div>",
                                className: "marker-cluster marker-cluster-" + o,
                                iconSize : new L.Point (a.iconSize[0], a.iconSize[1])
                            })
                        }
                    });
                    s.markers.forEach (function (e) {
                        s.config.icon.iconUrl = "./img/" + e.icon;
                        var t = L.icon (s.config.icon), a = L.marker (e.coords, {icon: t}), i = a.bindPopup (e.popup);
                        r.addLayer (a), "candidates" === o && n.toggleMarkerClass (i)
                    }), e.addLayer (r), this.disableScroll (jQuery ("#" + s.config.id), e)
                }
            }
        }, toggleMarkerClass: function (e) {
            e.on ("popupopen", function (e) {
                jQuery (e.popup._source._icon).addClass ("active-marker")
            }), e.on ("popupclose", function (e) {
                jQuery (e.popup._source._icon).removeClass ("active-marker")
            })
        }, disableScroll    : function (e, t) {
            t.scrollWheelZoom.disable (), e.bind ("mousewheel DOMMouseScroll", function (e) {
                e.stopPropagation (), 1 == e.ctrlKey ? (e.preventDefault (), t.scrollWheelZoom.enable (), setTimeout (function () {
                    t.scrollWheelZoom.disable ()
                }, 1e3)) : t.scrollWheelZoom.disable ()
            })
        }
    }, CRUMINA.initSmoothScroll = function () {
        if ("querySelector" in document && "addEventListener" in window) {
            for (var e = o ("#primary-menu a[href*=\\#], .btn[href*=\\#]").filter (function () {
                return o (this).is (":not([href=\\#])")
            }), t = 0, a = e.length; t < a; t++) {
                new RegExp (window.location.hostname + window.location.pathname).test (e[t].href) && e[t].setAttribute ("data-scroll", !0)
            }
            if (window.location.hash) {
                var i = document.querySelector (window.location.hash),
                    n = document.querySelector ('a[href*="' + window.location.hash + '"]');
                smoothScroll.animateScroll (i, n, {})
            }
            smoothScroll.init ({
                selector : "[data-scroll]",
                speed    : 500,
                easing   : "easeOutQuad",
                offset   : s.height (),
                updateURL: !0,
                callback : function (e, t) {
                }
            }), o ("#primary-menu").find ("[href=\\#]").on ("click", function () {
                return !1
            })
        }
    }, CRUMINA.initTextareaEditor = function () {
        var e = o ("#froala-editor");
        e.length && e.froalaEditor ()
    }, CRUMINA.Swiper = {
        $swipers            : {}, init: function () {
            var i = this;
            o (".swiper-container").each (function (e) {
                var t = o (this), a = "swiper-unique-id-" + e;
                t.addClass (a + " initialized").attr ("id", a), t.closest (".crumina-module").find (".swiper-pagination").addClass ("pagination-" + a), i.$swipers[a] = new Swiper ("#" + a, i.getParams (t, a)), i.addEventListeners (i.$swipers[a])
            })
        }, getParams        : function (e, t) {
            var a = {
                parallax                : !0,
                breakpoints             : !1,
                keyboardControl         : !0,
                setWrapperSize          : !0,
                preloadImages           : !0,
                updateOnImagesReady     : !0,
                prevNext                : !!e.data ("prev-next") && e.data ("prev-next"),
                changeHandler           : e.data ("change-handler") ? e.data ("change-handler") : "",
                direction               : e.data ("direction") ? e.data ("direction") : "horizontal",
                mousewheelControl       : !!e.data ("mouse-scroll") && e.data ("mouse-scroll"),
                mousewheelReleaseOnEdges: !!e.data ("mouse-scroll") && e.data ("mouse-scroll"),
                slidesPerView           : e.data ("show-items") ? e.data ("show-items") : 1,
                slidesPerGroup          : e.data ("scroll-items") ? e.data ("scroll-items") : 1,
                spaceBetween            : e.data ("space-between") || 0 == e.data ("space-between") ? e.data ("space-between") : 20,
                centeredSlides          : !!e.data ("centered-slider") && e.data ("centered-slider"),
                autoplay                : e.data ("autoplay") ? parseInt (e.data ("autoplay"), 10) : 0,
                loop                    : 0 != e.data ("loop") || e.data ("loop"),
                effect                  : e.data ("effect") ? e.data ("effect") : "slide",
                pagination              : {
                    type     : e.data ("pagination") ? e.data ("pagination") : "bullets",
                    el       : ".pagination-" + t,
                    clickable: !0
                },
                coverflow               : {
                    stretch     : e.data ("stretch") ? e.data ("stretch") : 0,
                    depth       : e.data ("depth") ? e.data ("depth") : 0,
                    slideShadows: !1,
                    rotate      : 0,
                    modifier    : 2
                },
                fade                    : {crossFade: !e.data ("crossfade") || e.data ("crossfade")}
            };
            return 1 < a.slidesPerView && (a.breakpoints = {
                480: {slidesPerView: 1, slidesPerGroup: 1},
                800: {slidesPerView: 2, slidesPerGroup: 2}
            }), a
        }, addEventListeners: function (t) {
            var e = t.$el.closest (".crumina-module-slider");
            t.params.prevNext && e.on ("click", ".swiper-btn-next, .swiper-btn-prev", function (e) {
                e.preventDefault (), o (this).hasClass ("swiper-btn-next") ? t.slideNext () : t.slidePrev ()
            })
        }
    }, jQuery (".back-to-top").on ("click", function () {
        return o ("html,body").animate ({scrollTop: 0}, 1200), !1
    }), CRUMINA.mediaPopups = function () {
        o (".js-popup-iframe").magnificPopup ({
            disableOn      : 700,
            type           : "iframe",
            mainClass      : "mfp-fade",
            removalDelay   : 160,
            preloader      : !1,
            fixedContentPos: !1
        }), o (".js-zoom-image, .link-image").magnificPopup ({
            type               : "image",
            removalDelay       : 500,
            callbacks          : {
                beforeOpen: function () {
                    this.st.image.markup = this.st.image.markup.replace ("mfp-figure", "mfp-figure mfp-with-anim"), this.st.mainClass = "mfp-zoom-in"
                }
            },
            closeOnContentClick: !0,
            midClick           : !0
        })
    }, CRUMINA.pricingSwitcher = function () {
        jQuery (".js-pricing-switcher").on ("click", function () {
            var e = o (this).prev ().is (":checked");
            o (this).closest (".crumina-pricings").find (".price").each (function () {
                e ? o (this).text (o (this).data ("annually")) : o (this).text (o (this).data ("monthly"))
            })
        })
    }, CRUMINA.IsotopeSort = function () {
        o (".sorting-container").each (function () {
            var t = o (this), e = t.data ("layout").length ? t.data ("layout") : "masonry";
            t.isotope ({
                itemSelector   : ".sorting-item",
                layoutMode     : e,
                percentPosition: !0
            }), t.imagesLoaded ().progress (function () {
                t.isotope ("layout")
            }), t.closest (".sorting-section-js").find (".sorting-menu").find ("li").on ("click", function () {
                if (o (this).hasClass ("active")) return !1;
                o (this).parent ().find (".active").removeClass ("active"), o (this).addClass ("active");
                var e = o (this).data ("filter");
                return void 0 !== e ? (t.isotope ({filter: e}), !1) : void 0
            })
        })
    }, CRUMINA.burgerAnimation = function () {
        var a = 80, i = 320, t = 80, n = 320;

        function e (e) {
            e.draw ("80% - 240", "80%", .3, {
                delay: .1, callback: function () {
                    e.draw ("100% - 545", "100% - 305", .6, {easing: ease.ease ("elastic-out", 1, .3)})
                }
            })
        }

        function o (e) {
            e.draw (t - 60, n + 60, .1, {
                callback: function () {
                    e.draw (t + 120, n - 120, .3, {easing: ease.ease ("bounce-out", 1, .3)})
                }
            })
        }

        function s (t) {
            t.draw ("90% - 240", "90%", .1, {
                easing: ease.ease ("elastic-in", 1, .3), callback: function () {
                    var e;
                    (e = t).draw ("20% - 240", "20%", .3, {
                        callback: function () {
                            e.draw (a, i, .7, {easing: ease.ease ("elastic-out", 1, .3)})
                        }
                    })
                }
            })
        }

        var r = document.getElementById ("pathD"), c = document.getElementById ("pathE"),
            l = document.getElementById ("pathF"), u = new Segment (r, a, i), p = new Segment (c, t, n),
            d = new Segment (l, a, i), h = document.getElementById ("menu-icon-wrapper"),
            g = document.getElementById ("menu-icon-trigger"), m = !0;
        h.style.visibility = "visible", g.onclick = function () {
            h.className = "menu-icon-wrapper scaled", m ? (e (u), o (p), e (d)) : (s (u), p.draw (t, n, .7, {
                delay : .1,
                easing: ease.ease ("elastic-out", 2, .4)
            }), s (d)), m = !m, setTimeout (function () {
                h.className = "menu-icon-wrapper"
            }, 450)
        }
    }, CRUMINA.tabsSmothScroll = {
        $tabs               : null, init: function () {
            this.$tabs = jQuery (".tabs-scroll"), this.addEventListeners ()
        }, addEventListeners: function () {
            this.$tabs.on ("shown.bs.tab", function (e) {
                var t = jQuery (e.target), a = jQuery (t.prop ("hash"));
                100 < window.scrollY || a.length && smoothScroll.animateScroll (a[0])
            })
        }
    }, CRUMINA.StickySidebars = function () {
        var e = o ("#site-header").height ();
        o (".crumina-sticky-sidebar").each (function () {
            new StickySidebar (this, {
                topSpacing          : e,
                bottomSpacing       : 20,
                containerSelector   : !1,
                innerWrapperSelector: ".sidebar__inner",
                stickyClass         : "is-affixed",
                minWidth            : 0
            })
        })
    }, CRUMINA.updateResponsiveInit = function () {
        var e = null;
        o (window).on ("resize", function () {
            null === e && (e = window.setTimeout (function () {
                e = null, CRUMINA.headerSpacer.resize ()
            }, 200))
        }).resize ()
    }, t.ready (function () {
        CRUMINA.select2Init (), CRUMINA.fixedHeader (), CRUMINA.Swiper.init (), CRUMINA.initSmoothScroll (), CRUMINA.mediaPopups (), CRUMINA.countdowns (), CRUMINA.pricingSwitcher (), CRUMINA.IsotopeSort (), CRUMINA.headerSpacer.init (), CRUMINA.tabsSmothScroll.init (), CRUMINA.primaryMenu (), CRUMINA.StickySidebars (), CRUMINA.maps.init (), CRUMINA.initTextareaEditor (), CRUMINA.updateResponsiveInit (), o ("#primary-menu").length && CRUMINA.burgerAnimation ()
    })
} (jQuery), $ (document).ready (function () {
});
