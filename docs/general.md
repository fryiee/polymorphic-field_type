# Polymorphic Field Type

- [Introduction](#introduction)
- [Configuration](#configuration)
- [Output](#output)


<a name="introduction"></a>
## Introduction

`anomaly.field_type.polymorphic`

The polymorphic field type a clean API to establish polymorphic relations between objects.

### Notes

- This field type is designed to be used by API only.

### Usage

Simply set the related entry in order to associate it.

    $entry->example = $related;

You may also use the relation method that is automatically compiled on the model.

    $entry->example()->associate($related);


<a name="output"></a>
## Output

This field type returns the related entry by default.

**Examples:**

    // Twig usage
    {{ entry.example.id }} or {{ entry.example.name }}
    
    // API usage
    $entry->example->id; or $entry->example->name;
