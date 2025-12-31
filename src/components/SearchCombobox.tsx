import * as React from "react"
import { Check, ChevronsUpDown, X } from "lucide-react"

import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
import {
    Command,
    CommandEmpty,
    CommandGroup,
    CommandInput,
    CommandItem,
    CommandList,
} from "@/components/ui/command"
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/components/ui/popover"
import { ComparisonItem } from "./PlatformCard"
import { Badge } from "@/components/ui/badge"

interface SearchComboboxProps {
    items: ComparisonItem[]
    selectedValues: string[]
    onSelect: (values: string[]) => void
    placeholder?: string
    hoverColor?: string
    primaryColor?: string
    compareLabel?: string
    onCompare?: () => void
    labels?: {
        selectProvider?: string;
        search?: string;
        noItemFound?: string;
        more?: string;
    }
}

export function SearchCombobox({
    items,
    selectedValues = [],
    onSelect,
    placeholder = "Select provider...",
    hoverColor,
    primaryColor,
    compareLabel,
    onCompare,
    labels,
}: SearchComboboxProps) {
    const [open, setOpen] = React.useState(false)
    const [isHovered, setIsHovered] = React.useState(false)

    // Generate a unique ID for scoping styles (simple hash or random string)
    const uniqueId = React.useMemo(() => "sc-" + Math.random().toString(36).substr(2, 9), []);

    const toggleSelection = (itemName: string) => {
        const isSelected = selectedValues.includes(itemName);
        let newValues;
        if (isSelected) {
            newValues = selectedValues.filter(v => v !== itemName);
        } else {
            // "One by one" selection - append
            newValues = [...selectedValues, itemName];
        }
        onSelect(newValues);
    };

    return (
        <Popover open={open} onOpenChange={setOpen}>
            {/* Inject dynamic styles for hover state */}
            {hoverColor && (
                <style>
                    {`
                    .${uniqueId} [cmdk-item][data-selected="true"] {
                        background-color: ${hoverColor}15 !important;
                        color: ${hoverColor} !important;
                    }
                    .${uniqueId} [cmdk-item][data-selected="true"] svg {
                        color: ${hoverColor} !important;
                    }
                    `}
                </style>
            )}
            <PopoverTrigger asChild>
                <Button
                    variant="outline"
                    role="combobox"
                    aria-expanded={open}
                    className="w-full justify-between font-normal transition-colors"
                    onMouseEnter={() => setIsHovered(true)}
                    onMouseLeave={() => setIsHovered(false)}
                    style={(open || isHovered) && hoverColor ? {
                        borderColor: hoverColor,
                        color: hoverColor,
                        backgroundColor: isHovered ? `${hoverColor}10` : undefined
                    } : {}}
                >
                    {selectedValues.length > 0 ? (
                        <div className="flex items-center gap-1 overflow-hidden">
                            {selectedValues.slice(0, 2).map(name => (
                                <Badge
                                    key={name}
                                    variant="secondary"
                                    className="px-1 font-normal text-xs flex items-center gap-1"
                                    style={primaryColor ? {
                                        backgroundColor: `${primaryColor}20`,
                                        color: primaryColor,
                                        borderColor: `${primaryColor}40`
                                    } : undefined}
                                >
                                    {name}
                                    <div
                                        role="button"
                                        onMouseDown={(e) => {
                                            e.preventDefault();
                                            e.stopPropagation();
                                        }}
                                        onClick={(e) => {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            toggleSelection(name);
                                        }}
                                        className="hover:bg-black/5 rounded-full p-0.5 transition-colors"
                                    >
                                        <X className="w-3 h-3" />
                                    </div>
                                </Badge>
                            ))}
                            {selectedValues.length > 2 && (
                                <span className="text-xs text-muted-foreground ml-1">
                                    +{selectedValues.length - 2} {labels?.more || "more"}
                                </span>
                            )}
                        </div>
                    ) : (
                        <span className="text-muted-foreground">{labels?.selectProvider || placeholder}</span>
                    )}
                    <ChevronsUpDown className="ml-2 h-4 w-4 shrink-0 opacity-50" />
                </Button>
            </PopoverTrigger>
            <PopoverContent className={`w-[--radix-popover-trigger-width] p-0 ${uniqueId}`} align="start">
                <Command>
                    <CommandInput placeholder={labels?.search || "Search..."} />
                    <CommandList>
                        <CommandEmpty>{labels?.noItemFound || "No item found."}</CommandEmpty>
                        <CommandGroup>
                            {items.map((item) => {
                                const isSelected = selectedValues.includes(item.name);
                                return (
                                    <CommandItem
                                        key={item.id}
                                        value={item.name}
                                        onSelect={() => toggleSelection(item.name)}
                                        className="cursor-pointer"
                                    >
                                        <Check
                                            className={cn(
                                                "mr-2 h-4 w-4",
                                                isSelected ? "opacity-100" : "opacity-0"
                                            )}
                                            style={isSelected && primaryColor ? { color: primaryColor } : undefined}
                                        />
                                        <div className="flex items-center gap-2">
                                            {item.logo && (
                                                <div className="w-6 h-6 rounded bg-muted/20 p-0.5 flex items-center justify-center shrink-0">
                                                    <img src={item.logo} alt="" className="w-full h-full object-contain" />
                                                </div>
                                            )}
                                            <span
                                                className={cn(isSelected && "font-medium")}
                                                style={isSelected && primaryColor ? { color: primaryColor } : undefined}
                                            >
                                                {item.name}
                                            </span>
                                        </div>
                                    </CommandItem>
                                )
                            })}
                        </CommandGroup>
                    </CommandList>
                    {/* Compare Button Footer */}
                    {selectedValues.length >= 2 && onCompare && (
                        <div className="p-2 border-t border-border bg-muted/20">
                            <CompareButton
                                count={selectedValues.length}
                                onCompare={onCompare}
                                setOpen={setOpen}
                                primaryColor={primaryColor}
                                hoverColor={hoverColor}
                                label={compareLabel}
                            />
                        </div>
                    )}
                </Command>
            </PopoverContent>
        </Popover>
    )
}

function CompareButton({
    count,
    onCompare,
    setOpen,
    primaryColor,
    hoverColor,
    label
}: {
    count: number,
    onCompare: () => void,
    setOpen: (open: boolean) => void,
    primaryColor?: string,
    hoverColor?: string,
    label?: string
}) {
    const [isHovered, setIsHovered] = React.useState(false);

    // Format label if it contains %s
    const buttonText = label ? label.replace('%s', count.toString()) : `Compare (${count}) Items`;

    return (
        <Button
            size="sm"
            className="w-full font-bold transition-colors duration-200"
            onClick={() => {
                onCompare();
                setOpen(false);
            }}
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
            style={{
                backgroundColor: isHovered && hoverColor ? hoverColor : (primaryColor || undefined),
                color: 'white'
            }}
        >
            {buttonText}
        </Button>
    );
}
