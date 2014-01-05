# 
# Use this SQL script to upgrade your Selectable Countries installation to Zen Cart v1.5.2 and later.
#
# Selectable Countries uses the field named "countries_active" to identify whether/not the associated country is active
# while Zen Cart v1.5.2 and later use the field named "status".
# 
# Upgrading your database requires two steps:
# 1) Removing the 'status' field from the 'countries' table
# 2) Modifying the 'countries_active' field from your Selectable Countries installation to the 'status' format.
#    Thanks to torvista for providing this SQL fragment!
#
ALTER TABLE countries DROP status;
ALTER TABLE countries CHANGE countries_active status tinyint(1) DEFAULT '1';