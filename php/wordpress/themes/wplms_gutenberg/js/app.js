(() => {
  // assets/js/app.js
  document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(".dark_light_switch")) {
      if (localStorage.getItem("dark_theme")) {
        document.querySelector("body").classList.add("dark_theme");
      }
      document.querySelector(".dark_light_switch").addEventListener("click", () => {
        if (document.querySelector("body").classList.contains("dark_theme")) {
          document.querySelector("body").classList.remove("dark_theme");
          localStorage.removeItem("dark_theme");
        } else {
          document.querySelector("body").classList.add("dark_theme");
          localStorage.setItem("minimise_side_header", 1);
        }
      });
    }
    if (document.querySelector(".searchbox")) {
      document.querySelector(".searchbox svg").addEventListener("click", (e) => {
        e.preventDefault();
        if (document.querySelector(".searchbox").classList.contains("active")) {
          document.querySelector(".searchbox").classList.remove("active");
        } else {
          document.querySelector(".searchbox").classList.add("active");
        }
      });
    }
    if (document.querySelector(".ajax-badge")) {
    }
  });
  var reframe = (target, cName) => {
    var _a, _b;
    var frames = typeof target === "string" ? document.querySelectorAll(target) : target;
    var c = cName || "js-reframe";
    if (!("length" in frames))
      frames = [frames];
    for (var i = 0; i < frames.length; i += 1) {
      var frame = frames[i];
      var hasClass = frame.className.split(" ").indexOf(c) !== -1;
      if (hasClass || frame.style.width.indexOf("%") > -1) {
        return;
      }
      var height = frame.getAttribute("height") || frame.offsetHeight;
      var width = frame.getAttribute("width") || frame.offsetWidth;
      var heightNumber = typeof height === "string" ? parseInt(height) : height;
      var widthNumber = typeof width === "string" ? parseInt(width) : width;
      var padding = heightNumber / widthNumber * 100;
      var div = document.createElement("div");
      div.className = c;
      var divStyles = div.style;
      divStyles.position = "relative";
      divStyles.width = "100%";
      divStyles.paddingTop = "".concat(padding, "%");
      var frameStyle = frame.style;
      frameStyle.position = "absolute";
      frameStyle.width = "100%";
      frameStyle.height = "100%";
      frameStyle.left = "0";
      frameStyle.top = "0";
      (_a = frame.parentNode) === null || _a === void 0 ? void 0 : _a.insertBefore(div, frame);
      (_b = frame.parentNode) === null || _b === void 0 ? void 0 : _b.removeChild(frame);
      div.appendChild(frame);
    }
  };
  var wplms_gutneberg_resize = () => {
    document.querySelectorAll("#main-menu > ul > li > .sub-menu >li").forEach((el) => {
      el.addEventListener("mouseenter", function(el2) {
        if (!el2.target.parentNode.classList.contains("openleft")) {
          let dimensions = el2.target.getBoundingClientRect();
          if (dimensions.right > window.innerWidth) {
            el2.target.parentNode.classList.add("openleft");
          }
        }
      });
    });
    document.querySelectorAll(".menu_icon_item").forEach((el) => {
      let icon = atob(el.getAttribute("data-icon"));
      if (icon.length < 400) {
        icon.split(" ").map((i) => el.classList.add(i));
      } else {
        el.innerHTML = icon;
      }
    });
    if (document.querySelector("header.site-header nav")) {
      let currentMenuitem = document.querySelector("#main-menu>ul>li");
      if (document.querySelector("#main-menu>ul>li.current-menu-item")) {
        currentMenuitem = document.querySelector("#main-menu>ul>li.current-menu-item");
      } else if (document.querySelector("#main-menu>ul>li.current-menu-ancestor")) {
        currentMenuitem = document.querySelector("#main-menu>ul>li.current-menu-ancestor");
      } else if (document.querySelector("#main-menu>ul>li.current_page_item")) {
        currentMenuitem = document.querySelector("#main-menu>ul>li.current_page_item");
      }
      document.querySelectorAll("#main-menu>ul>li").forEach((el, i) => {
        if (window.innerWidth > 960) {
          let rect = null;
          el.addEventListener("mouseenter", () => {
            rect = el.getBoundingClientRect();
            document.querySelector(".mega_menu_root_active_highlight").style.left = "calc(" + rect.x + "px - 0.5rem)";
            document.querySelector(".mega_menu_root_active_highlight").style.width = "calc(" + rect.width + "px + 1rem)";
          });
          el.addEventListener("mouseleave", () => {
            rect = currentMenuitem.getBoundingClientRect();
            document.querySelector(".mega_menu_root_active_highlight").style.left = "calc(" + rect.x + "px - 0.5rem)";
            document.querySelector(".mega_menu_root_active_highlight").style.width = "calc(" + rect.width + "px + 1rem)";
          });
        }
      });
      if (currentMenuitem) {
        let rect = currentMenuitem.getBoundingClientRect();
        currentMenuitem.classList.add("active");
        document.querySelector(".mega_menu_root_active_highlight").style.left = "calc(" + rect.x + "px - 0.5rem)";
        document.querySelector(".mega_menu_root_active_highlight").style.width = "calc(" + rect.width + "px + 1rem)";
      }
    }
    sticky_block();
    reframe("iframe");
  };
  var sticky_block = function() {
    if (document.querySelector("#vibebpmember")) {
      document.querySelectorAll(".sticky_block").forEach(function(el) {
        var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        if (w > 768) {
          var cwidth = el.offsetWidth;
          var contentHeight = document.querySelector("#vibebpmember").offsetHeight;
          var top = 0;
          var etop = el.getBoundingClientRect().top;
          var endheight = top + contentHeight - el.offsetHeight - etop;
          el.style.width = cwidth + "px";
          window.addEventListener("scroll", function(event) {
            var st = window.pageYOffset;
            if (st < endheight) {
              if (st > etop) {
                el.style.transform = "translateY(" + st + "px)";
              } else {
                el.style.transform = "none";
              }
            }
          }, false);
        }
      });
    }
  };
  window.addEventListener("scroll", (event) => {
    document.querySelectorAll(".vibe_animate").forEach((el) => {
      if (isInViewport(el)) {
        el.classList.add("loaded");
        if (document.querySelector("." + el.getAttribute("id"))) {
          document.querySelector("." + el.getAttribute("id")).classList.add("active");
        }
      }
    });
  }, false);
  document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
      wplms_gutneberg_resize();
    }, 100);
    if (document.querySelectorAll("header.site-header nav .menu-item")) {
      document.querySelectorAll("header.site-header nav .menu-item").forEach(function(el) {
        if (el.querySelector(".megadrop")) {
          el.classList.add("hasmegamenu");
          el.style.position = "static";
          var attr = el.querySelector(".megadrop").getAttribute("data-width");
          if (attr != "100%" && attr != "container") {
            el.style.position = "relative";
            let nattr = parseInt(attr.replace("px", ""));
            if (!isNaN(nattr)) {
              el.querySelector(".sub-menu").style.left = "-" + (Math.round(nattr / 2, 2) - 30) + "px";
            }
          }
          el.querySelector(".sub-menu").style.width = attr;
        }
      });
      if (document.querySelector(".mega_sub_posts_menu")) {
        document.querySelector(".mega_menu_term").classList.add("active");
        document.querySelector(".mega_sub_posts_menu").classList.add("active");
        document.querySelectorAll(".mega_menu_term").forEach((el) => {
          el.addEventListener("mouseenter", () => {
            if (document.querySelector("." + el.getAttribute("data-id") + "_posts")) {
              if (el.parentNode.querySelector(".mega_menu_term.active")) {
                el.parentNode.querySelector(".mega_menu_term.active").classList.remove("active");
              }
              el.classList.add("active");
              if (el.parentNode.parentNode.querySelector(".mega_sub_posts_menu.active")) {
                el.parentNode.parentNode.querySelector(".mega_sub_posts_menu.active").classList.remove("active");
              }
              el.parentNode.parentNode.querySelector("." + el.getAttribute("data-id") + "_posts").classList.add("active");
            }
          });
        });
      }
    }
    if (document.querySelector(".menu-item-has-children") && window.innerWidth < 768) {
      document.querySelectorAll(".menu-item-has-children").forEach((el) => {
        el.addEventListener("click", function(e) {
          if (e.target.nodeName == "LI") {
            e.preventDefault();
            el.classList.toggle("active");
            e.stopPropagation();
          }
        });
      });
    }
  });
  window.addEventListener("resize", wplms_gutneberg_resize);
  document.addEventListener("userLoaded", wplms_gutneberg_resize);
  var CountUp = class {
    constructor(el) {
      const counter = el.querySelector(".counter");
      const trigger = el.querySelector(".start-counter");
      let num = 0;
      const decimals = counter.dataset.decimals;
      let increment = counter.dataset.increment;
      const countUp = () => {
        if (num < counter.dataset.stop)
          if (decimals) {
            if (!increment) {
              increment = 0.01;
            }
            num += increment;
            counter.textContent = new Intl.NumberFormat("en-GB", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            }).format(num);
          } else {
            if (!increment) {
              increment = 1;
            }
            num = num + increment;
            counter.textContent = num;
          }
      };
      const observer = new IntersectionObserver((el2) => {
        if (el2[0].isIntersecting) {
          const interval = setInterval(() => {
            num < counter.dataset.stop ? countUp() : clearInterval(interval);
          }, counter.dataset.speed);
        }
      }, { threshold: [0] });
      observer.observe(trigger);
    }
  };
  var vibetabs = () => {
    if (document.querySelector(".vibe_tabs")) {
      document.querySelectorAll(".vibe_tabs").forEach((vts) => {
        if (!vts.querySelector(".vibe_tabs_list > li.active")) {
          let activeli = vts.querySelector(".vibe_tabs_list > li:first-child");
          vts.querySelector(".vibe_tab." + activeli.classList[0]).classList.add("active");
          activeli.classList.add("active");
        }
        vts.querySelectorAll(".vibe_tabs_list > li").forEach((li) => {
          li.addEventListener("click", () => {
            if (!li.classList.contains("active")) {
              vts.querySelector(".vibe_tabs_list > li.active").classList.remove("active");
              li.classList.add("active");
              let classes = li.classList;
              if (vts.querySelector(".vibe_tab." + classes[0])) {
                vts.querySelector(".vibe_tab.active").classList.remove("active");
                vts.querySelector(".vibe_tab." + classes[0]).classList.add("active");
                document.dispatchEvent(new Event("VibeBP_Editor_Content"));
              }
            }
          });
        });
      });
    }
  };
  document.addEventListener("DOMContentLoaded", () => {
    vibetabs();
    if (document.querySelector("#open_menu_toggle")) {
      document.querySelector("#open_menu_toggle").addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector(".site_mobile_menu").classList.toggle("hidden");
        setTimeout(() => {
          document.querySelector(".site_mobile_menu").classList.toggle("active");
        }, 300);
      });
    }
    if (document.querySelector("#close_menu_toggle")) {
      document.querySelector("#close_menu_toggle").addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector(".site_mobile_menu").classList.toggle("active");
        setTimeout(() => {
          document.querySelector(".site_mobile_menu").classList.toggle("hidden");
        }, 300);
      });
    }
    if (document.querySelector(".white_bg")) {
      document.querySelectorAll(".white_bg").forEach((el) => {
        var newContent = "<div class='squares'> <div class='square'></div> <div class='square'></div> <div class='square'></div> <div class='square'></div> <div class='square'></div> <div class='square'></div> <div class='square'></div> <div class='square'></div> <div class='square'></div> <div class='square'></div> </div>";
        el.insertAdjacentHTML("beforeend", newContent);
      });
    }
    if (document.querySelector(".particles_bg")) {
      document.querySelectorAll(".particles_bg").forEach((el) => {
        var newContent = '<div class="particles_container"><div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div> <div class="particle"></div></div>';
        el.insertAdjacentHTML("beforeend", newContent);
      });
    }
    if (document.querySelector(".counter_wrap")) {
      document.querySelectorAll(".counter_wrap").forEach((el) => {
        new CountUp(el);
      });
    }
  });
})();
