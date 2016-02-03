# Conference Management System for Gobind Sarvar Schools

## Setting up local environment

You need a local PHP and MySQL environment to run the Laravel application that supports PHP version >= 5.5.9, OpenSSL, PDO, Mbstring and Tokenizer PHP Extension. The easiest way to get this up is to use MAMP, which bundles all the necessary stack application on your local machine.

## Coding Guidelines

All elements of the project that is written in PHP should follow the PSR-1 coding standards.

- Code MUST follow a "coding style guide" PSR [PSR-1].
- Code MUST use 4 spaces for indenting, not tabs.
- There MUST NOT be a hard limit on line length; the soft limit MUST be 120 characters; lines SHOULD be 80 characters or less.
- There MUST be one blank line after the namespace declaration, and there MUST be one blank line after the block of use declarations.
- Opening braces for classes MUST go on the next line, and closing braces MUST go on the next line after the body.
- Opening braces for methods MUST go on the next line, and closing braces MUST go on the next line after the body.
- Visibility MUST be declared on all properties and methods; abstract and final MUST be declared before the visibility; static MUST be declared after the visibility.
- Control structure keywords MUST have one space after them; method and function calls MUST NOT.
- Opening braces for control structures MUST go on the same line, and closing braces MUST go on the next line after the body.
- Opening parentheses for control structures MUST NOT have a space after them, and closing parentheses for control structures MUST NOT have a space before.

#### Example

```php
<?php
namespace Vendor\Package;

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class Foo extends Bar implements FooInterface
{
    public function sampleFunction($a, $b = null)
    {
        if ($a === $b) {
            bar();
        } elseif ($a > $b) {
            $foo->bar($arg1);
        } else {
            BazClass::bar($arg2, $arg3);
        }
    }

    final public static function bar()
    {
        // method body
    }
}
```

## Contribution Guidelines

To introduce a new feature or bug fixes, make sure you adhere to the following committing/pushing guideline.

#### Branching off the `master` branch

First, do a `git pull` to get the latest commits on the master branch.

```shell
$  git checkout -b 'name_of_branch'
```

Follow the convention of branch naming. E.g. 7_user-accounts

The number is the issue ID for your feature/bug-fix, followed by an `_` and a short description of the changes introduced, with `-` separating each word.

#### Commit and push changes to your branch

To add all files changed to your commit, do

```shell
$  git add .
```

from the home of the repository's root directory

```shell
$  git commit -m 'Implement user authentication'
```

Make sure you give a meaningful commit message so everyone else knows what your commit is about when it gets merged into master

#### Create a pull request

From BitBucket, create a pull request of your feature/bug-fix branch. Make sure you cc everybody in the team (or at least people that needs to review the changes) about the PR when it is ready to be merged. Ask other members of the team to review your code and run automatic tests against their local deployment.

The comments in the PR should include a reference to the original issue that motivated the pull request. 

#### Merge into master

If there's a merge conflict as flagged by BitBucket, do a `git merge master` to incorporate the latest changes from master into your own branch, resolving any merge conflicts if there are any. At this point, your PR should be able to merge into `master` automatically. Merge into `master` from BitBucket and close the issue that motivated the pull request.

If needs be, notify other members of the team about the merge.

## Automatic deployment (Continuous Integration)

[Deploybot](http://deploybot.com) is a great tool to automatically deploy an application to an FTP server (in our project, it would be the GoDaddy hosting) on every push to the `master` branch. 