# consumer Version 1.0
Consumer is a PHP  script to get data for diffrent types of data sources like "APIS" , "FILES"
and when you get them just put your database saving logic to save them .
### Documentation
Apis:
```
$consumer->API('https://reqres.in/api/','users','POST',['name'=>'morpheus','job'=>'leader']);
$consumer->API('https://reqres.in/api/','users','GET',[]);
```
Files:
```
$consumer->file(__DIR__,'json','dummy.json');
$consumer->file(__DIR__,'csv','test.csv');

```
