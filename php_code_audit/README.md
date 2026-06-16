# PHP Code Audit

PHP 模块采用 **Psalm + Semgrep** 技术栈，目录说明如下：

| 目录 | 用途 |
|------|------|
| `semgrep_rules/` | Semgrep 规则（模式匹配，广覆盖召回） |
| `psalm_rules/` | Psalm 污点分析配置（source → sink，降误报） |
| `code_audit_skills/` | LLM Agent Skills（链路分析、PoC 生成、验证步骤） |
| `vuln_examples/` | 可运行漏洞样例（规则正样本 + 本地验证） |

建议从 `vuln_examples/` 复现漏洞，再在 `semgrep_rules/`、`psalm_rules/` 中补充对应检测规则，并在 `code_audit_skills/` 中维护配套 Skill。
