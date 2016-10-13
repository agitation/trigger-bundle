ag.ns("ag.trigger");

(function(){
var
    url = ag.cfg,

    triggerHandler = function(loadMsg, successMsg)
    {
        this.extend(this, ag.ui.tool.tpl("agtrigger", ".trigger-handler"));

        this.find(".loading .ind").html(new ag.ui.elem.Spinner());
        this.find(".loading .msg").html(loadMsg);
        this.find(".success").html(successMsg);
    },

    action = function(token)
    {
        $.get({
            url : ag.cfg.baseUrl + "trigger/" + token,
            dataType : "text",
            error : responseHandler.bind(this, "error"),
            success : responseHandler.bind(this, "success")
        });
    },

    responseHandler = function(status)
    {
        this.removeClass("loading").addClass(status);
    };

triggerHandler.prototype = Object.create(ag.ui.ctxt.Block.prototype);

triggerHandler.prototype.getAction = function()
{
    return action.bind(this);
};

ag.trigger.TriggerHandler = triggerHandler;

})();
