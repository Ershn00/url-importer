## Tech stack
- PHP 8.2
- Symfony 6.3

## Database
- Mysql (using Docker)

## Description
*Symfony application that allows users to import URLs from a CSV file. The application consist of just one form to select the CSV file. The URLs are inserted into a MySQL table.
Before inserting the URLs, check if they are already in the table so we don’t insert duplicates. After the form is submitted inform the user how many URLs have been added to the table.*

## Constraints
- "Filter" folder includes "DuplicateFilter" class that checks 
if the URL is included in the table. Any filter to be identified as a
class can be included in the "FilterChain" class that loops all filters defined.
