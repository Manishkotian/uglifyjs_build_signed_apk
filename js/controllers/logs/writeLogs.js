function writeLogsToFile(logLevel,message,logType){
	var configuration = new Configuration();
	/*
	// logType : 1 - only file logs
	// logTtpe : 2 - only browser logs
	// logType : 3 - both browser and file logs
	*/
	if(logType == 1){
		writeOnlyFileLogs(logLevel,message);
	}
	else if(logType == 2){
		writeOnlyBrowserLogs(configuration,logLevel,message);
	}
	else{
		writeOnlyFileLogs(logLevel,message);
		writeOnlyBrowserLogs(configuration,logLevel,message);
	}
}
function writeOnlyFileLogs(logLevel,message){
	if(ENABLE_FILE_LOGS){
		switch(logLevel){
			case 'info': window.logToFile.info(message);
					break;
			case 'debug' : window.logToFile.debug(message);
					break;
			case 'warn' : window.logToFile.warn(message);
					break;
			case 'error' : window.logToFile.error(message);
					break;
		}
	}
}
function writeOnlyBrowserLogs(configuration,logLevel,message){
	if(configuration.ENABLE_CONSOLE_LOGS){
		switch(logLevel){
			case 'info': console.info(message);
					break;
			case 'debug' : console.log(message);
					break;
			case 'warn' : console.warn(message);
					break;
			case 'error' : console.error(message);
					break;
		}
	}
}