(function($) {
	'use strict';
	
	var workflow = {};
	edgtf.modules.workflow = workflow;

    workflow.edgtfWorkflow = edgtfWorkflow;


    workflow.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
        edgtfWorkflow();
	}

    function edgtfWorkflow() {
        var workflowShortcodes = $('.edgtf-workflow');
        if (workflowShortcodes.length) {
            workflowShortcodes.each(function () {
                var workflowShortcode = $(this);
                if (workflowShortcode.hasClass('edgtf-workflow-animate')) {
                    var workflowItems = workflowShortcode.find('.edgtf-workflow-item');

                    workflowShortcode.appear(function () {
                        workflowShortcode.addClass('edgtf-appeared');
                        setTimeout(function () {
                            workflowItems.each(function (i) {
                                var workflowItem = $(this);
                                setTimeout(function () {
                                    workflowItem.addClass('edgtf-appeared');
                                }, 350 * i);
                            });
                        }, 350);
                    }, {accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

                }
            });
        }
    }
	
})(jQuery);