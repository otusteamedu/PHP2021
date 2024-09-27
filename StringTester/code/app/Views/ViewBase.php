<?php


namespace AppCore\Views;

use AppCore\Exception\RenderException;

class ViewBase
{
    protected array $variables = [];
    protected string $coreTplPath;
    protected string $coreTplFile = "index.html";
    protected string $featureTplPath;

    public function __construct(string $coreTplPath, string $featureTplPath)
    {
        $this->coreTplPath = $coreTplPath;
        $this->featureTplPath = $featureTplPath;
    }

    public function renderView(string $tplPath, array $variables): string
    {
        $this->variables = $this->variables + $variables;
        $keys = [];
        $values = [];
        foreach ($this->variables as $key => $value) {
            $keys[] = "{" . strtoupper($key) . "}";
            $values[] = $value;
        }

        if (!$result = file_get_contents($this->featureTplPath . "/" . $tplPath)) {
            throw new \Exception("Can't find tpl file : $tplPath ");
        }
        $result = str_replace($keys, $values, $result);
        $mainContent = file_get_contents($this->coreTplPath . "/" . $this->coreTplFile);
        $mainContent = str_replace($keys, $values, $mainContent);
        return str_replace("{_CONTENT_}", $result, $mainContent);

    }

    public function setVariable($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

}