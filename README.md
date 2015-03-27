
							Databases extended assessment
 							=============================

 Description
 -----------

 	This is a program to list out local shoe stores and the brands of shoes they carry.
 
 Functionality 
 -------------

 	As a user that application allow you to : check all the brands sold by a store
 			                        		  add a store to a brand
 			                        		  check all the stores where a brand is sold
 			                        		  add a brand to a store

pgsql command :
---------------

CREATE DATABASE shoes;
\c shoes;
CREATE TABLE brands (id serial PRIMARY KEY, name varchar);
CREATE TABLE stores (id serial PRIMARY KEY, name varchar);
CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id int, store_id int);
CREATE DATABASE shoes_test WITH TEMPLATE shoes;
\c shoes_test;






copyright (c) 

By Virginie Trubiano