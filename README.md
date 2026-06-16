# Code_Audit_Skills

**维护者**：n0tepad  
**仓库**：[n0tepad-pro/Code_Audit_Skills](https://github.com/n0tepad-pro/Code_Audit_Skills)

---

## 背景

大模型技术快速演进，正在改变 CTF 与代码审计的传统工作方式。当前模型对源码的理解能力已经相当成熟，不少团队已将 LLM 引入 CTF 解题、Web 代码审计与漏洞挖掘流程。

但实践中有一个明显缺口：**仅靠「Skill + 丢一段代码给模型」远远不够。**

常见问题在于：

1. **上下文不足**：真实项目的路由、调用链、配置、过滤逻辑无法在一次对话里完整呈现。
2. **误报泛滥**：静态规则或模型往往只盯「危险函数」，忽略路由是否可达、前置过滤是否生效、参数是否可控。
3. **缺少可验证结论**：审计报告里写「可能存在 SQL 注入」与「存在可稳定利用的 PoC」是两回事。CTF 与实战都需要后者。

因此，本项目探索的是一种 **「经典审计方法论 + 规则引擎 + 调用链 + LLM Skill」** 的组合路径：先缩小范围，再精准确认，最后产出 **真实可利用的 PoC**。

---

## 核心思路

```text
路由 / 入口构图  →  规则扫描可疑点  →  链路分析与可达性判断  →  LLM Skill 编写 PoC  →  本地验证
```

| 阶段 | 做什么 | 产出 |
|------|--------|------|
| **1. 路由构图** | 梳理 HTTP 路由、控制器、Handler、include 关系 | 入口 → sink 的可疑路径候选 |
| **2. 规则扫描** | PHP 用 Semgrep + Psalm；Java/Python/Go/C/C++ 用 CodeQL | 告警点 + 规则 ID + 源码位置 |
| **3. 链路分析** | 结合调用链判断：是否路由可达、过滤是否可 bypass、sink 是否可控 | 高置信「待验证」漏洞链 |
| **4. LLM Skill** | 将 **链路上下文 + 规则命中 + Skill 模板** 交给模型，生成 exploit 思路与 PoC | 可执行的 payload / 脚本 |
| **5. PoC 验证** | 在 vuln_examples 或靶场环境中复现，确认可利用性 | 验证通过 / 误报剔除 |

**设计原则**：规则负责 **Recall（找 suspects）**，链路负责 **Precision（筛 reachable）**，Skill + PoC 负责 **Confirm（证 exploitable）**。

---

## 技术方案

本仓库按语言选用不同的静态分析基座。**CodeQL 官方不支持 PHP**，因此 PHP 与其他语言采用不同组合：

| 语言 | 静态分析方案 | 分工说明 |
|------|--------------|----------|
| **PHP** | **[Psalm](https://psalm.dev/) + [Semgrep](https://semgrep.dev/)** | Semgrep 负责模式规则与广覆盖召回；Psalm `--taint-analysis` 负责 source → sink 污点追踪，降低误报 |
| **Java** | **[CodeQL](https://codeql.github.com/)** | 跨过程数据流 + QL 查询，覆盖 Spring 等常见框架场景 |
| **Python** | **CodeQL** | 与 Java 同栈，规则与查询统一维护 |
| **Go** | **CodeQL** | 与 Java 同栈 |
| **C / C++** | **CodeQL** | 内存安全、缓冲区等问题分析 |

```text
PHP：  路由构图 → Semgrep 规则 → Psalm 污点 → Skill 写 PoC → 验证
其他：  路由构图 → CodeQL 查询 → 链路分析 → Skill 写 PoC → 验证
```

---

## 仓库结构

按 **语言模块** 组织，每种语言自包含规则、Skill 与漏洞样例：

```text
Code_Audit_Skills/
├── README.md
│
├── php_code_audit/
│   ├── semgrep_rules/       # Semgrep YAML 规则
│   ├── psalm_rules/         # Psalm 污点分析配置
│   ├── code_audit_skills/   # LLM Agent Skills（PoC 生成、链路分析等）
│   └── vuln_examples/       # 可运行漏洞样例（正样本）
│
├── java_code_audit/
│   ├── codeql_rules/
│   ├── code_audit_skills/
│   └── vuln_examples/
│
├── python_code_audit/
│   ├── codeql_rules/
│   ├── code_audit_skills/
│   └── vuln_examples/
│
├── go_code_audit/
│   ├── codeql_rules/
│   ├── code_audit_skills/
│   └── vuln_examples/
│
└── c_cpp_code_audit/
    ├── codeql_rules/
    ├── code_audit_skills/
    └── vuln_examples/
```

每个 `vuln_examples/` 条目 ideally 配套：

- 对应 `*_rules/` 中的检测规则（应命中）
- 可选 `*_chain.md`（路由与调用链，与样例同目录或同编号）
- 对应 `code_audit_skills/` 中的 Skill（指导 LLM 写 PoC）

详见各语言目录下的 `README.md`。

---

## 当前内容（Phase 0 · PHP）

`php_code_audit/vuln_examples/` 下已有 **18 道 PHP Web 审计样例**（由历史 CTF 题目整理），用作 Semgrep / Psalm 规则与 Skill 开发的 **正样本基准**。

### 本地运行

```bash
php -S 127.0.0.1:8080 -t .
# 示例：http://127.0.0.1:8080/php_code_audit/vuln_examples/01_lfi.php
```

### 样例索引

| 文件 | 漏洞类型 |
|------|----------|
| [01_lfi.php](php_code_audit/vuln_examples/01_lfi.php) | LFI · 伪协议 |
| [02_strcmp_bypass.php](php_code_audit/vuln_examples/02_strcmp_bypass.php) | `strcmp` 绕过 |
| [03_weak_type_compare.php](php_code_audit/vuln_examples/03_weak_type_compare.php) | 弱类型 `==` / `===` |
| [04_numeric_bypass.php](php_code_audit/vuln_examples/04_numeric_bypass.php) | `is_numeric()` 绕过 |
| [05_ereg_null_trunc.php](php_code_audit/vuln_examples/05_ereg_null_trunc.php) | `ereg()` `%00` 截断 |
| [06_weak_type_eq_zero.php](php_code_audit/vuln_examples/06_weak_type_eq_zero.php) | 弱类型 `$a==0` |
| [07_file_get_contents.php](php_code_audit/vuln_examples/07_file_get_contents.php) | 伪协议 + `file_get_contents` |
| [08_extract.php](php_code_audit/vuln_examples/08_extract.php) | `extract` 变量覆盖 |
| [09_custom_header_1.php](php_code_audit/vuln_examples/09_custom_header_1.php) | 自定义 Header（一） |
| [10_custom_header_2.php](php_code_audit/vuln_examples/10_custom_header_2.php) | 自定义 Header（二） |
| [11_x_forwarded_for.php](php_code_audit/vuln_examples/11_x_forwarded_for.php) | `X-Forwarded-For` |
| [12_url_encode_mismatch.php](php_code_audit/vuln_examples/12_url_encode_mismatch.php) | URL 编解码不一致 |
| [13_sqli_business_logic.php](php_code_audit/vuln_examples/13_sqli_business_logic.php) | 业务逻辑 SQL 注入 |
| [14_encrypt_decrypt.php](php_code_audit/vuln_examples/14_encrypt_decrypt.php) | 加解密逻辑 |
| [15_sha1_bypass.php](php_code_audit/vuln_examples/15_sha1_bypass.php) | `sha1()` 缺陷 |
| [16_parse_url_host_bypass.php](php_code_audit/vuln_examples/16_parse_url_host_bypass.php) | `parse_url` / Host 校验 |
| [17_md5_sqli_login.php](php_code_audit/vuln_examples/17_md5_sqli_login.php) | `md5` + SQL 登录 |
| [18_file_upload_bypass.php](php_code_audit/vuln_examples/18_file_upload_bypass.php) | 文件上传绕过 |

辅助文件：`Y29uZmln.php`、`class.php`、`f1aG.php`、`flag.txt` 等（均在 `vuln_examples/`）。

### 首个端到端样板（计划中 · `01_lfi`）

| 路径 | 内容 |
|------|------|
| `php_code_audit/semgrep_rules/lfi.yaml` | LFI 模式规则 |
| `php_code_audit/psalm_rules/` | 污点 source/sink 配置 |
| `php_code_audit/vuln_examples/01_lfi_chain.md` | `$_GET['page']` → `include()` 链路 |
| `php_code_audit/code_audit_skills/lfi-poc/SKILL.md` | LLM 生成 LFI PoC 步骤 |
| `php_code_audit/vuln_examples/01_lfi.md` | 原理与验证记录（可选） |

---

## PoC 验证

| 场景 | 工具 |
|------|------|
| PHP 样例本地运行 | `php -S 127.0.0.1:8080 -t .` |
| HTTP 手工验证 | Burp Suite、curl |
| 规则回归 | Semgrep / Psalm / CodeQL 对 `vuln_examples` 应命中 |

---

## 贡献与路线图

- [x] 按语言模块搭建目录骨架（PHP / Java / Python / Go / C++）
- [x] PHP 样例迁入 `php_code_audit/vuln_examples/`
- [ ] GitHub 仓库更名为 `Code_Audit_Skills`
- [ ] 完成 `01_lfi` 全链路样板（semgrep + psalm + skill + chain）
- [ ] Java / Python 各 1 个 CodeQL 样板
- [ ] CI：规则对 `vuln_examples` 命中，干净代码不误报

欢迎提交规则、样例、Skill 与已验证 PoC。

---

## 声明

- 样例代码来源于 CTF 平台或公开改编，**仅供安全学习与审计研究**。
- 请勿将本题代码或 PoC 用于未授权测试或生产环境。
