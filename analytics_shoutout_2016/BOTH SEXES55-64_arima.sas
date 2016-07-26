ods noproctitle;
ods graphics / imagemap=on;


proc sort data=SASSHOOT.DISEASE_LABOR_CENSUS65_V3 out=Work.preProcessedData;
	by Year;
run;
title4 '(MALE55-64)';
proc arima data=Work.preProcessedData plots
    (only)=(series(corr crosscorr) residual(corr normal) 
		forecast(forecastonly));
	identify var='MALE55-64'n crosscorr=('BOTH SEXES55-64'n);
	estimate p=(1) (1) q=(1) (1) input=('BOTH SEXES55-64'n) method=ML;
	forecast lead=60 back=0 alpha=0.05 id=Year interval=YEAR;
	outlier;
	run;
quit;

proc delete data=Work.preProcessedData;
run;

ods noproctitle;
ods graphics / imagemap=on;

proc sort data=SASSHOOT.DISEASE_LABOR_CENSUS65_V3 out=Work.preProcessedData;
	by Year;
run;
title4 '(FEMALE55-64)';
proc arima data=Work.preProcessedData plots
    (only)=(series(corr crosscorr) residual(corr normal) 
		forecast(forecastonly));
	identify var='FEMALE55-64'n crosscorr=('BOTH SEXES55-64'n);
	estimate p=(1) (1) q=(1) (1) input=('BOTH SEXES55-64'n) method=ML;
	forecast lead=60 back=0 alpha=0.05 id=Year interval=YEAR;
	outlier;
	run;
quit;

proc delete data=Work.preProcessedData;
run;

ods noproctitle;
ods graphics / imagemap=on;

proc sort data=SASSHOOT.DISEASE_LABOR_CENSUS65_V3 out=Work.preProcessedData;
	by Year;
run;
title4 '(FEMALE65+)';
proc arima data=Work.preProcessedData plots
    (only)=(series(corr crosscorr) residual(corr normal) 
		forecast(forecastonly));
	identify var='FEMALE65+'n crosscorr=('BOTH SEXES55-64'n);
	estimate p=(1) (1) q=(1) (1) input=('BOTH SEXES55-64'n) method=ML;
	forecast lead=60 back=0 alpha=0.05 id=Year interval=YEAR;
	outlier;
	run;
quit;

proc delete data=Work.preProcessedData;
run;

ods noproctitle;
ods graphics / imagemap=on;

proc sort data=SASSHOOT.DISEASE_LABOR_CENSUS65_V3 out=Work.preProcessedData;
	by Year;
run;
title4 '(MALE65+)';
proc arima data=Work.preProcessedData plots
    (only)=(series(corr crosscorr) residual(corr normal) 
		forecast(forecastonly));
	identify var='MALE65+'n crosscorr=('BOTH SEXES55-64'n);
	estimate p=(1) (1) q=(1) (1) input=('BOTH SEXES55-64'n) method=ML;
	forecast lead=60 back=0 alpha=0.05 id=Year interval=YEAR;
	outlier;
	run;
quit;

proc delete data=Work.preProcessedData;
run;
