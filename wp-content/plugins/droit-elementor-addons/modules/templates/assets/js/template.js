!(function ($, $elementor, $droit) {
    "use strict";
    var $config = {};
    var $append = '<div class="elementor-add-section-area-button dl_templates_add_button"><img src="'+droitEditor.templateLogo+'" /></div>';
    
    window.liteTranslated = function (e, t) {
        return elementorCommon.translate(e, null, t, droitEditor.i18n)
    };
    
    var $app = {
        Views: {},
        Models: {},
        Collections: {},
        Behaviors: {},
        Layout: null,
        Manager: null
    };

    var $modal, $search, $dlist, $loader, $eleDialogsM;
    var tabs = {

    };

    var $responsive = {
        desktop: "100%",
        tab: "768px",
        mobile: "360px"
    };

    $app.Models.Template = Backbone.Model.extend({
        defaults: {
            template_id: 0,
            title: "",
            type: "",
            thumbnail: "",
            url: "",
            liveurl: "",
            favorite: "",
            tags: [],
            isPro: !1
        }
    }), 
    $app.Collections.Template = Backbone.Collection.extend({
        model: $app.Models.Template
    }), 
    $app.Behaviors.InsertTemplate = Marionette.Behavior.extend({
        ui: {
            insertButton: ".liteTemplateLibrary_insert-button"
        },
        events: {
            "click @ui.insertButton": "onInsertButtonClick"
        },
        onInsertButtonClick: function() {
            $droitTemp.insertTemplate({
                model: this.view.model
            })
        }
    }), 
    $app.Views.EmptyTemplateCollection = Marionette.ItemView.extend({
        id: "elementor-template-library-templates-empty",
        template: "#droit-liteTemplateLibrary_empty",
        ui: {
            title: ".elementor-template-library-blank-title",
            message: ".elementor-template-library-blank-message"
        },
        modesStrings: {
            empty: {
                title: liteTranslated("templatesEmptyTitle"),
                message: liteTranslated("templatesEmptyMessage")
            },
            noResults: {
                title: liteTranslated("templatesNoResultsTitle"),
                message: liteTranslated("templatesNoResultsMessage")
            }
        },
        getCurrentMode: function() {
            return $droitTemp.getFilter("text") ? "noResults" : "empty"
        },
        onRender: function() {
            var e = this.modesStrings[this.getCurrentMode()];
            this.ui.title.html(e.title), this.ui.message.html(e.message)
        }
    }), 
    $app.Views.Loading = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_loading",
        id: "liteTemplateLibrary_loading"
    }), 
    $app.Views.Logo = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_header-logo",
        className: "liteTemplateLibrary_header-logo",
        templateHelpers: function() {
            return {
                title: this.getOption("title")
            }
        }
    }), 
    $app.Views.BackButton = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_header-back",
        id: "elementor-template-library-header-preview-back",
        className: "liteTemplateLibrary_header-back",
        events: function() {
            return {
                click: "onClick"
            }
        },
        onClick: function() {
            $droitTemp.showTemplatesView()
        }
    }), 
    $app.Views.Menu = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_header-menu",
        id: "elementor-template-library-header-menu",
        className: "liteTemplateLibrary_header-menu",
        templateHelpers: function() {
            return $droitTemp.getTabs()
        },
        ui: {
            menuItem: ".elementor-template-library-menu-item"
        },
        events: {
            "click @ui.menuItem": "onMenuItemClick"
        },
        onMenuItemClick: function(e) {
            $droitTemp.setFilter("tags", ""), 
            $droitTemp.setFilter("text", ""), 
            $droitTemp.setFilter("type", e.currentTarget.dataset.tab, !0), $droitTemp.showTemplatesView()
        }
    }), 
    $app.Views.ResponsiveMenu = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_header-menu-responsive",
        id: "elementor-template-library-header-menu-responsive",
        className: "liteTemplateLibrary_header-menu-responsive",
        ui: {
            items: "> .elementor-component-tab"
        },
        events: {
            "click @ui.items": "onTabItemClick"
        },
        onTabItemClick: function(t) {
            var $a = $(t.currentTarget),
                $n = $a.data("tab");
            $droitTemp.channels.tabs.trigger("change:device", $n, $a)
        }
    }), 
    $app.Views.Actions = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_header-actions",
        id: "elementor-template-library-header-actions",
        ui: {
            sync: "#liteTemplateLibrary_header-sync i"
        },
        events: {
            "click @ui.sync": "onSyncClick"
        },
        onSyncClick: function() {
            var e = this;
            e.ui.sync.addClass("eicon-animation-spin"), $droitTemp.requestLibraryData({
                onUpdate: function() {
                    e.ui.sync.removeClass("eicon-animation-spin"), $droitTemp.updateBlocksView()
                },
                forceUpdate: !0,
                forceSync: !0
            })
        }
    }), 
    $app.Views.InsertWrapper = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_header-insert",
        id: "elementor-template-library-header-preview",
        behaviors: {
            insertTemplate: {
                behaviorClass: $app.Behaviors.InsertTemplate
            }
        }
    }), 
    $app.Views.Preview = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_preview",
        className: "liteTemplateLibrary_preview",
        ui: function() {
            return {
                img: "> img"
            }
        },
        onRender: function() {
            this.ui.img.attr("src", this.getOption("url")).hide();
            var e = this,
                t = (new $app.Views.Loading).render();
            this.$el.append(t.el), this.ui.img.on("load", function() {
                e.$el.find("#liteTemplateLibrary_loading").remove(), e.ui.img.show()
            })
        }
    }), 
    $app.Views.TemplateCollection = Marionette.CompositeView.extend({
        template: "#droit-liteTemplateLibrary_templates",
        id: "liteTemplateLibrary_templates",
        className: function() {
            return "liteTemplateLibrary_templates liteTemplateLibrary_templates--" + $droitTemp.getFilter("type")
        },
        childViewContainer: "#liteTemplateLibrary_templates-list",
        emptyView: function() {
            return new $app.Views.EmptyTemplateCollection
        },
        ui: {
            templatesWindow: ".liteTemplateLibrary_templates-window",
            textFilter: "#liteTemplateLibrary_search",
            tagsFilter: "#droit_temp_filter-tags",
            filterBar: "#liteTemplateLibrary_toolbar-filter",
            counter: "#liteTemplateLibrary_toolbar-counter"
        },
        events: {
            "input @ui.textFilter": "onTextFilterInput",
            "click @ui.tagsFilter li": "onTagsFilterClick"
        },
        getChildView: function(e) {
            return $app.Views.Template
        },
        initialize: function() {
            this.listenTo($droitTemp.channels.templates, "filter:change", this._renderChildren)
        },
        filter: function(e) {
            var t = $droitTemp.getFilterTerms(),
                a = !0;
            return _.each(t, function(t, n) {
                var r = $droitTemp.getFilter(n);
                if (r && t.callback) {
                    var l = t.callback.call(e, r);
                    return l || (a = !1), l
                }
            }), a
        },
        setMasonrySkin: function() {
            if ("section" === $droitTemp.getFilter("type")) {
                var e = new elementorModules.utils.Masonry({
                    container: this.$childViewContainer,
                    items: this.$childViewContainer.children()
                });
                this.$childViewContainer.imagesLoaded(e.run.bind(e))
            }
        },
        onRenderCollection: function() {
            this.setMasonrySkin(), this.updatePerfectScrollbar(), this.setTemplatesFoundText()
        },
        setTemplatesFoundText: function() {
            var text;
            var e = $droitTemp.getFilter("type"),
                t = this.children.length;
            text = "<strong>" + t + "</strong>", text += "section" === e ? " block" : " " + e, t > 1 && (text += "s"), text += " found", this.ui.counter.html(text)
        },
        onTextFilterInput: function() {
            var e = this;
            _.defer(function() {
                $droitTemp.setFilter("text", e.ui.textFilter.val())
            })
        },
        onTagsFilterClick: function(t) {
            var $a = $(t.currentTarget),
                $n = $a.data("tag");
            $droitTemp.setFilter("tags", $n), $a.addClass("active").siblings().removeClass("active"), n = n ? $droitTemp.getTags()[$n] : "Filter", this.ui.filterBar.find(".droit_temp_filter-btn").html($n + ' <i class="eicon-caret-down"></i>')
        },
        updatePerfectScrollbar: function() {
            this.perfectScrollbar || (this.perfectScrollbar = new PerfectScrollbar(this.ui.templatesWindow[0], {
                suppressScrollX: !0
            })), this.perfectScrollbar.isRtl = !1, this.perfectScrollbar.update()
        },
        setTagsFilterHover: function() {
            var e = this;
            e.ui.filterBar.hoverIntent(function() {
                e.ui.tagsFilter.addClass("droit_temp_filter-show"), e.ui.filterBar.find(".droit_temp_filter-btn i").addClass("eicon-caret-down").removeClass("eicon-caret-right")
            }, function() {
                e.ui.tagsFilter.removeClass("droit_temp_filter-show");
                e.ui.tagsFilter.addClass("droit_temp_filter-hide"), e.ui.filterBar.find(".droit_temp_filter-btn i").addClass("eicon-caret-right").removeClass("eicon-caret-down")
            }, {
                sensitivity: 50,
                interval: 150,
                timeout: 100
            })
        },
        onRender: function() {
            this.setTagsFilterHover(), this.updatePerfectScrollbar()
        }
    }), 
    $app.Views.Template = Marionette.ItemView.extend({
        template: "#droit-liteTemplateLibrary_template",
        className: "liteTemplateLibrary_template",
        ui: {
            previewButton: ".liteTemplateLibrary_preview-button, .liteTemplateLibrary_template-preview"
        },
        events: {
            "click @ui.previewButton": "onPreviewButtonClick"
        },
        behaviors: {
            insertTemplate: {
                behaviorClass: $app.Behaviors.InsertTemplate
            }
        },
        onPreviewButtonClick: function() {
            $droitTemp.showPreviewView(this.model)
        }
    }), 
    $app.Modal = elementorModules.common.views.modal.Layout.extend({
        getModalOptions: function() {
            return {
                id: "liteTemplateLibrary_modal",
                hide: {
                    onOutsideClick: !1,
                    onEscKeyPress: !0,
                    onBackgroundClick: !1
                }
            }
        },
        getTemplateActionButton: function(e) {
            var t = e.isPro && !droitEditor.hasPro ? "pro-button" : "insert-button";
            var viewId, template;
            return viewId = "#droit-liteTemplateLibrary_" + t, template = Marionette.TemplateCache.get(viewId), Marionette.Renderer.render(template)
        },
        showLogo: function(e) {
            this.getHeaderView().logoArea.show(new $app.Views.Logo(e))
        },
        showDefaultHeader: function() {
            this.showLogo({
                title: "TEMPLATES"
            });
            var e = this.getHeaderView();
            e.tools.show(new $app.Views.Actions), e.menuArea.show(new $app.Views.Menu)
        },
        showPreviewView: function(e) {
            var t = this.getHeaderView();
            t.menuArea.show(new $app.Views.ResponsiveMenu), t.logoArea.show(new $app.Views.BackButton), t.tools.show(new $app.Views.InsertWrapper({
                model: e
            })), this.modalContent.show(new $app.Views.Preview({
                url: e.get("url")
            }))
        },
        showTemplatesView: function(e) {
            this.showDefaultHeader(), this.modalContent.show(new $app.Views.TemplateCollection({
                collection: e
            }))
        }
    });
 
    var $droitInt = {
        init: function(){

        }
    },
    $droitLoad = {
        init: function(){

        }
    }, 
    $droitTemp = {
        init: function(){
            window.elementor.on("preview:loaded", $droitTemp.onEditorLoaded), $droitInt.init(), $droitLoad.init();
           
        },
        onEditorLoaded: function () {
            let $el =  window.elementor.$previewContents;
            let $time = setInterval(() => {
                $el.find(".elementor-add-new-section").length && ($droitTemp.initAddButton( $el ), clearInterval($time));
            }, 100);

            $el.on("click.onAddTemplateButton", ".dl_templates_add_button", $droitTemp.showModal), $droitTemp.channels.tabs.on("change:device", $droitTemp.changeTab)
        },
        initAddButton: function ( $el ) {
            let $newSection = $el.find(".elementor-add-new-section");
            let $top = $el.closest(".elementor-top-section");
            let $dl = $newSection.find('.elementor-add-section-drag-title');
            $dl.length && !$el.find(".dl_templates_add_button").length && $dl.before($append); 
            $el.on("click.onAddElement", ".elementor-editor-section-settings .elementor-editor-element-add", $droitTemp.appendCheck);
        },

        appendCheck : function(){
            let $el =  window.elementor.$previewContents;
            let $top = $el.closest(".elementor-top-section"),
                $id = $top.data("id"),
                $dl = $top.find('.elementor-add-section-drag-title')
                $child = $dl.documents.getCurrent().container.children,
                $section = $top.prev(".elementor-add-section");
                $child && _.each($child, function(e, t) {
                    $id === e.id && (this.atIndex = t)
                }), 
                $section.find(".dl_templates_add_button").length || $section.find('.elementor-add-new-section > .elementor-add-section-drag-title').before($append);
        },

        changeTab: function(t, i){
            i.addClass("elementor-active").siblings().removeClass("elementor-active");
            var a = $responsive[t] || $responsive.desktop;
            $(".liteTemplateLibrary_preview").css("width", a)

            
        },
        showModal: function() {
            $droitTemp.getModal().showModal(), $droitTemp.showTemplatesView()
        },
        closeModal : function() {
            $droitTemp.getModal().hideModal()
        },
        getModal : function() {
            return $modal || ($modal = new $app.Modal), $modal
        },
        showTemplatesView : function() {
            let $this = this;
            $droitTemp.setFilter("tags", "", !0), $droitTemp.setFilter("text", "", !0), $loader ? $droitTemp.getModal().showTemplatesView($loader) : $droitTemp.loadTemplates(function() {
                $this.getModal().showTemplatesView($loader)
            })
        },
        atIndex : -1,
        channels : {
            tabs: Backbone.Radio.channel("tabs"),
            templates: Backbone.Radio.channel("templates")
        },
        updateBlocksView : function() {
            $droitTemp.setFilter("tags", "", !0), $droitTemp.setFilter("text", "", !0), $droitTemp.getModal().showTemplatesView(c)
        },
        setFilter : function(e, t, i) {
            $droitTemp.channels.templates.reply("filter:" + e, t), i || $droitTemp.channels.templates.trigger("filter:change")
        },
        getFilter : function(e) {
            return $droitTemp.channels.templates.request("filter:" + e)
        },
        getFilterTerms : function() {
            return {
                tags: {
                    callback: function(e) {
                        return _.any(this.get("tags"), function(t) {
                            return t.indexOf(e) >= 0
                        })
                    }
                },
                text: {
                    callback: function(e) {
                        return e = e.toLowerCase(), this.get("title").toLowerCase().indexOf(e) >= 0 || _.any(this.get("tags"), function(t) {
                            return t.indexOf(e) >= 0
                        })
                    }
                },
                type: {
                    callback: function(e) {
                        return this.get("type") === e
                    }
                }
            }
        },

        getTabs : function() {
            var e = this.getFilter("type");
            return (
                (tabs = { section: { title: "Blocks" }, page: { title: "Pages" } }),
                _.each(tabs, function (t, i) {
                    e === i && (tabs[e].active = !0);
                }),
                { tabs: tabs }
            );
        },
        getTags : function() {
            return $search
        },
        getTypeTags : function() {
            var e = this.getFilter("type");
            return $dlist[e]
        }, 
        showTemplatesView : function() {
            let $this = this;
            $droitTemp.setFilter("tags", "", !0), $droitTemp.setFilter("text", "", !0), $loader ? $droitTemp.getModal().showTemplatesView($loader) : $droitTemp.loadTemplates(function() {
                $droitTemp.getModal().showTemplatesView($loader)
            })
        },
        showPreviewView : function(e) {
            $droitTemp.getModal().showPreviewView(e)
        },
        loadTemplates : function(e) {
            let $this = this;
            $droitTemp.requestLibraryData({
                onBeforeUpdate: $droitTemp.getModal().showLoadingView.bind($droitTemp.getModal()),
                onUpdate: function() {
                    $droitTemp.getModal().hideLoadingView(), e
                }
            })
        },
        requestLibraryData : function(e) {
            if ($loader && !e.forceUpdate) return void(e.onUpdate && e.onUpdate());
            e.onBeforeUpdate && e.onBeforeUpdate();
            var t = {
                data: {},
                success: function(t) {
                    $loader = new $app.Collections.Template(t.templates), t.tags && ($search = t.tags), t.type_tags && ($dlist = t.type_tags), e.onUpdate && e.onUpdate()
                }
            };
            e.forceSync && (t.data.sync = !0), elementorCommon.ajax.addRequest("get_lite_library_data", t)
        },
        requestTemplateData : function(e, t) {
            var $dat = {
                unique_id: e,
                data: {
                    edit_mode: !0,
                    display: !0,
                    template_id: e
                }
            };
            t && jQuery.extend(!0, $dat, $elementor), elementorCommon.ajax.addRequest("get_lite_template_data", $dat)
        },
        insertTemplate : function(e) {
            var t = e.model,
                i = $droitTemp;
            i.getModal().showLoadingView(), i.requestTemplateData(t.get("template_id"), {
                success: function(e) {
                    i.getModal().hideLoadingView(), i.getModal().hideModal();
                    var a = {}; - 1 !== i.atIndex && (a.at = i.atIndex), $e.run("document/elements/import", {
                        model: t,
                        data: e,
                        options: a
                    }), i.atIndex = -1
                },
                error: function(e) {
                    i.showErrorDialog(e)
                },
                complete: function(e) {
                    i.getModal().hideLoadingView(), window.elementor.$previewContents.find(".elementor-add-section .elementor-add-section-close").click()
                }
            })
        },
        showErrorDialog : function(e) {
            if ("object" == typeof e) {
                var t = "";
                _.each(e, function(e) {
                    t += "<div>" + e.message + ".</div>"
                }), e = t
            } else e ? e += "." : e = "<i>&#60;The error message is empty&#62;</i>";
            this.getErrorDialog().setMessage('The following error(s) occurred while processing the request:<div id="elementor-template-library-error-info">' + e + "</div>").show()
        },
        getErrorDialog : function() {
            return $eleDialogsM || ($eleDialogsM = elementorCommon.dialogsManager.createWidget("alert", {
                id: "elementor-template-library-error-dialog",
                headerMessage: "An error occurred"
            })), $eleDialogsM
        }
    };
   
    // load elementor editor
    $(window).on("elementor:init", $droitTemp.init);

    $droit.library = $droitTemp;
    window.droit = $droit;
   
    console.log(window);

})(jQuery, window.elementor, window.droit || {});

