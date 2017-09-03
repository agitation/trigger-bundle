ag.ns("ag.trigger");

(function(){
var TriggerHandler = function(loadMsg, successMsg)
{
    this.extend(this, ag.ui.tool.tpl("agtrigger", ".trigger-handler"));

    this.find(".loading .ind").html(new ag.ui.elem.Spinner());
    this.find(".loading .msg").html(loadMsg);
    this.find(".success p").html(successMsg);

    this.registerController(action.bind(this));
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

TriggerHandler.prototype = Object.create(ag.ui.ctxt.Block.prototype);


ag.trigger.TriggerHandler = TriggerHandler;

})();
