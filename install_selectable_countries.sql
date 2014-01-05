# Selectable Countries Plugin - Install SQL to add the countries_active field to the countries table.
ALTER TABLE countries ADD countries_active char(1) default 1;