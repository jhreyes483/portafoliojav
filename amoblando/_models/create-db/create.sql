# drop database amoblando;
create database amoblando;
use amoblando;

create table credits(
id_credits  integer(10) not null primary key auto_increment,
term  integer(10) not null,
state  integer(6) not null
);


create table dues(
id_dues integer(10) not null primary key auto_increment,
name integer(6) not null,
fk_credits integer(10) not null
);
alter table dues add  constraint dues_fk foreign key(fk_credits) references credits(id_credits) on update cascade on delete cascade;

create table payment(
id_payment  integer(10) not null primary key auto_increment,
name_payment varchar(50) not null
);

create table categories(
id_cate  integer(10) not null primary key auto_increment,
name_c varchar(50) not null
);

create table roles(
id_rol  integer(10)not null primary key auto_increment ,
name_rol varchar(30),
assignment_date  date not null,
state  varchar(3) not null,
permits  varchar(20)
);

create table document_types(
acron  varchar(5) not null primary key,
name_doc  varchar(35) not null
);

create table products(
id_prod  integer(10) not null primary key auto_increment,
name_prod  varchar(50) not null,
prices integer(20) not null,
stok  integer(30) not null,
est_com  varchar(15) not null,
est_sis  varchar(5) not null,
descript  varchar(200),
create_date  date not null,
fk_cate  integer(10) not null
);
alter table products add  constraint fk_cate foreign key(fk_cate) references categories(id_cate) on update cascade on delete cascade;

create table users(
id_doc  integer(15) not null,
name1 varchar(30) not null,
name2 varchar(30) not null,
last_name1  varchar(30) not null,
last_name2  varchar(30) not null,
email  varchar(30) not null,
create_date  date not null,
gender varchar(30) not null,
img  blob,
password varchar(200) not null,
fk_rol  integer(10) not null,
fk_doc_acron  varchar(5)
);

alter table users add constraint fk_doc_acron foreign key (fk_doc_acron) references document_types(acron) on update cascade on delete cascade;
alter table users add primary key (id_doc,fk_doc_acron);
alter table users add  constraint fk_rol foreign key(fk_rol) references roles(id_rol) on update cascade on delete cascade;

create table invoices(
id_factura integer(10) not null primary key,
total integer(30),
date_inv  date,
iva  integer(30),
fk_payment integer(10),
fk_credits integer(10),
fk_user integer(15),
fk_doc  varchar(5)
);
alter table invoices add  constraint fk_credits foreign key(fk_credits) references credits(id_credits) on update cascade on delete cascade;
alter table invoices add  constraint fk_payment foreign key(fk_payment) references payment(id_payment) on update cascade on delete cascade;
alter table invoices add  constraint fk_user foreign key(fk_user) references users(id_doc ) on update cascade on delete cascade;
alter table invoices add  constraint fk_payment foreign key(fk_payment) references payment(id_payment) on update cascade on delete cascade;



create table invoices_products(
sub_total integer(10),
amount  integer(10),
fk_invoices integer(10),
fk_prod integer(10)
);
alter table invoices_products add  constraint fk_invoices foreign key(fk_invoices) references invoices(id_factura) on update cascade on delete cascade;
alter table invoices_products add  constraint fk_prod foreign key(fk_prod) references products(id_prod) on update cascade on delete cascade;
alter table invoices_products add primary key (fk_invoices ,fk_prod);














