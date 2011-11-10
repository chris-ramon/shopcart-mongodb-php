use shoppingCart
obj1={_id:1,name:"Saint Seiya Next Dimension vol 1",description:"Continuacion del famoso manga de los 80",price:45.00};
obj2={_id:2,name:"Saint Seiya Lost Canvas vol 1",description:"Conoce la guerra santa hace 248 anhos con Tenma",price:55.00};
obj3={_id:3,name:"Gantz vol 28",description:"Descubre cientos de esferas de Gantz en Alemania",price:40.00};
obj4={_id:4,name:"Rurouni Kenshin vol 28",description:"Desenlace saga Enishi",price:49.00};
obj5={_id:5,name:"Dragon Ball Despedida",description:"Final de la hisoria de Toriyama",price:35.00};
obj6={name:"Death Note vol 1",description:"Conoce a L y Yagami Light",price:24.00};
usr={name:"system",password:"personal",type:"admin"};
usr={name:"carlitos",password:"none",type:"customer"};

db.users.save(usr);


db.products.save(obj1);
db.products.save(obj2);
db.products.save(obj3);

db.products.save(obj4);
db.products.save(obj5);
db.products.save(obj6);
var cursor = db.products.find();
while (cursor.hasNext()) printjson(cursor.next());


