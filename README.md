## Tech stack
- PHP 8.2
- Symfony 6.3

## Database
- Mysql (using Docker)

## Comments
*Before inserting the URLs, we want to check if they are already in the table so we don’t insert duplicates. After the form is submitted we inform the user how many URLs have been added to the table.*

**"Filter" folder includes "DuplicateFilter" class that checks 
if the URL is included in the table. Any filter to be identified as a
class can be included in the "FilterChain" class that loops all filters defined.**

*Additional Requirements:*

*1/ The table can grow to millions of URLs. However, we can’t have the user wait more than a couple of seconds for inserting CSV files with tens of thousands of URLs. What are the usual approaches?*

**The usual approach is submitting task to a message queue with 
Symfony Messenger to process it in the background. I wasn't sure it this 
implementation was part of the scope of the exercise, so I did not implement 
it. Please let me know if I should do it.**

*2/ The URLs can be up to 2048 characters. What problem are we facing? How to solve that problem?*

**The problem would be if the URL entity type was Varchar. Therefore, I 
defined the type as "Text". It might cause performance issues when reading 
the text fields, but technologies such as ElasticSearch can be used for full-text 
search.**

*3/ We want all versions of the same URL to match. For instance, if 2 URLs differ only by the scheme, they are considered the same URL. If one URL has the default port 80 and another has no port, they are considered the same URL. If the URLs have the same query parameters and values but in different orders, they are considered the same URL.
Note: you don’t have to implement all conditions of this constraint. Just show that you understand what is required.*

**I did not apply all conditions of this constraint. The ones I implemented are 
in the "Filter" directory. All filters are injected into a loop in "FilterChain" 
class, so as many filters can be added to process any number of conditions.**
