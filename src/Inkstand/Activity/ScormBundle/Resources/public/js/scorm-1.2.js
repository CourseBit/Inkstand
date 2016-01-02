

var Scorm12API = function() {

    var STATE_NOT_INITIALIZED = 0;
    var STATE_INITIALIZED = 1;
    var STATE_FINISHED = 2;

    var errorMessages = {
        0: "No error",
        101: "General exception",
        201: "Invalid argument error",
        202: "Element cannot have children",
        203: "Element not an array - cannot have count",
        301: "Not initialized",
        401: "Not implemented error",
        402: "Invalid set value, element is a keyword",
        403: "Element is read only",
        404: "Element is write only",
        405: "Incorrect Data Type"
    };

    var properties = {
        executionState: STATE_NOT_INITIALIZED,
        lastErrorCode: "0",
        debug: true
    };

    var LMSInitialize = function(parameter) {

        debug("LMSInitialize(" + parameter + ")");

        setExecutionState(STATE_INITIALIZED);

        return "true";
    };

    var LMSFinish = function(parameter) {

        debug("LMSFinish(" + parameter + ")");

        var dataCommited =  LMSCommit("");

        if(dataCommited == "false") {
            return "false";
        }

        setExecutionState(STATE_FINISHED);

        return "true";
    };

    var LMSGetValue = function(parameter) {
        debug("LMSGetValue(" + parameter + ")");
    };

    var LMSSetValue = function(parameter, value) {
        debug("LMSSetValue(" + parameter + ", " + value + ")");
    };

    var LMSCommit = function(parameter) {
        debug("LMSCommit(" + parameter + ")");
    };

    var LMSGetLastError = function() {
        debug("LMSGetLastError()");
    };

    var LMSGetErrorString = function(errornumber) {
        debug("LMSGetErrorString(" + errornumber + ")");

        if(errorMessages.hasOwnProperty(errornumber)) {
            return errorMessages[errornumber];
        } else {
            return "An error occurred.";
        }
    };

    var LMSGetDiagnostic = function(parameter) {
        debug("LMSGetDiagnostic(" + parameter + ")");

        if(parameter === "") {
            parameter = properties.lastErrorCode;
        }

        return LMSGetErrorString(parameter);
    };

    var getExecutionState = function() {
        return properties.executionState;
    };

    var setExecutionState = function(executionState) {
        switch(executionState) {
            case STATE_NOT_INITIALIZED:
            case STATE_INITIALIZED:
            case STATE_FINISHED:
                properties.executionState = executionState;
                break;
            default:
                throw new Error("Invalid execution state.");
        }
    };

    var isNotStarted = function() {
        return properties.executionState == STATE_NOT_INITIALIZED;
    };

    var isInitialized = function() {
        return properties.executionState == STATE_INITIALIZED;
    };

    var isFinished = function() {
        return properties.executionState == STATE_FINISHED;
    };

    var debug = function(message) {
        if(properties.debug) {
            console.log("SCORM Debug: " + message);
        }
    };

    return {
        LMSInitialize: LMSInitialize,
        LMSFinish: LMSFinish,
        LMSGetValue: LMSGetValue,
        LMSSetValue: LMSSetValue,
        LMSCommit: LMSCommit,
        LMSGetLastError: LMSGetLastError,
        LMSGetErrorString: LMSGetErrorString,
        LMSGetDiagnostic: LMSGetDiagnostic
    }
};

var API = new Scorm12API();