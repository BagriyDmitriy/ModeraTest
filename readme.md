A task:
=====================
---------------------------------------------------------------------------
We have a text file with structured tree information in form of:
---
```
    node_id|parent_id|node_name
    node_id: numeric node id
    parent_id: id of parent node
```
Main task is to represent this tree with correct paddings for every level, 
level one - zero paddings, level two - one padding and so on.

Try to write code as simple as possible and we want to see high perfomance solution
---

---------------------------------------------------------------------------
Input data:
---
```
1|0|Electronics
2|0|Video
3|0|Photo
4|1|MP3 player
5|1|TV
6|4|iPod
7|6|Shuffle
8|3|SLR
9|8|DSLR
10|9|Nikon
11|9|Canon
12|11|20D
```
---
Output data:
---
```
Electronics
-MP3 player
--iPod
---Shuffle
-TV
Video
Photo
-SLR
--DSLR
---Nikon
---Canon
----20D
```
---

Fragments of the project work:
=====================
   `views:`
   **index**
---------------------------------------------------------------------------
![screenshot of file contents](https://github.com/mslobodyanyuk/ModeraTest/blob/master/public/images/index.png)
---------------------------------------------------------------------------
   **upload**	
---------------------------------------------------------------------------
![screenshot of file contents](https://github.com/mslobodyanyuk/ModeraTest/blob/master/public/images/upload.png)
---------------------------------------------------------------------------
   **list**
---------------------------------------------------------------------------	
![screenshot of file contents](https://github.com/mslobodyanyuk/ModeraTest/blob/master/public/images/list.png)	
![screenshot of file contents](https://github.com/mslobodyanyuk/ModeraTest/blob/master/public/images/list1.png)
---------------------------------------------------------------------------




After `composer install` ModeraTest folder in the Project copy the contents of the folder and remove folder.
---
PHP namespace provides the ability to group logically related classes, interfaces, functions and constants.
Folders and namespaces must be the same, to make sure it was convenient to their classes to use in other projects, only moving the folder.
All classes must be based on a level higher than the `\ public`.
The public is only the entry point, it is for the safe.
On one level, with `general` `public` and create a folder `src` - it all the classes and code for this project.
It create a controller, view. db-structure model in `general`, **we do not have it here**.

class distribution of folders for namespaces:
```
    src
    Factory \ GoodsFactory
    Composite \ CompositeGoods
    Iterator \ IteratorGoods
    the rest - general
```	

    src                        | general
-------------------------------|----------------------
    Factory \ GoodsFactory     | File \ File
    Composite \ CompositeGoods | File \ TextFile
    Iterator \ IteratorGoods   | Parser \ TextParser


    File, TextFile, Parser - Reusable may be used.
    GoodsFactory, CompositeGoods, IteratorGoods - only in this project.


The applied (used in) patterns.
=====================
Design pattern - a task taken from the best practices of software development, the solution of which is analyzed and explain.
Matt Zandstra - PHP. Objects, patterns and programming techniques - 2011.
Since the formulation of job wanted to see High Performance solution, applied use of the following design patterns:

    Composite 
    Factory Method 
    Iterator 

**Composite**. It unites objects in a tree structure to represent the hierarchy from the private to the whole.
Builder allows clients to separate objects and groups of objects equally. The main purpose of the pattern
It is to provide a single interface to both the composite and the final object that the client did not think of, from the object of how it works.
<https://en.wikipedia.org/wiki/Composite_pattern>

**Factory Method**. Used to define and maintain relationships between the objects.
Factory methods eliminate the need for the designer to embed in the code depending on the application classes.
<https://en.wikipedia.org/wiki/Factory_method_pattern>

**Iterator**. Object that allows to sort all items in the collection without taking into account the peculiarities of its implementation.
Iterator. It represents an object that allows you to get consistent access to the elements of the object-unit without the use of an
each of the objects included in the aggregation.
<https://en.wikipedia.org/wiki/Iterator_pattern>

